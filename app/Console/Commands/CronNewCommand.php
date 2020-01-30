<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\News;
use App\Models\Push;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class CronNewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '2048M');
        ignore_user_abort(true);
        set_time_limit(1200);

        $news = News::where('type', 0)
            ->where('auto_push', 1)
            ->where('start_date', '<=', Carbon::now())
            ->first();
        if (is_null($news)) {
            Log::info(['new']);
            dd('exit');
        }
        Log::info(['start' => $news->id]);
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        //notification
        $notificationBuilder = new PayloadNotificationBuilder('遠東福音會');
        $notificationBuilder->setBody($news->title)
            ->setSound('default');

        $option       = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data         = [
            'firstClass' => "A",
            'secClass'   => (string) $news->id,
        ];

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
        $dataBuild = $dataBuilder->build();
        $news->type = 1;
        $news->save();
        Device::where('receiveNoti', 1)->chunk(50, function ($devices) use ($option, $notification, $dataBuild) {
            foreach ($devices as $device) {
                FCM::sendTo($device->token, $option, $notification, $dataBuild);
            }
        });
        Log::info(['end' => $news->id]);
    }
}
