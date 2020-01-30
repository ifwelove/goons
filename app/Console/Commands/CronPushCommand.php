<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Push;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class CronPushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:push';

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

        //@立即推播status=1 and type=0
        $nowPush = Push::where('type', 0)
            ->where('status', 1)
            ->first();
        //@預約推播status=0 and type=0 and start_date 等於預約時間,
        $orderPush = Push::where('type', 0)
            ->where('status', 0)
            ->where('start_date', '<=', Carbon::now())
            ->first();
        if (is_null($orderPush) && is_null($nowPush)) {
            Log::info(['push']);
            dd('exit');
        }
        if (! is_null($nowPush)) {
            $push = $nowPush;
        }
        if (! is_null($orderPush)) {
            $push = $orderPush;
        }
        Log::info(['start' => $push->id]);
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        //notification
        $notificationBuilder = new PayloadNotificationBuilder($push->title);
        $notificationBuilder->setBody($push->sub_title)
            ->setSound('default');

        $option       = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data         = json_decode($push->url, true);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
        $dataBuild = $dataBuilder->build();
        $push->type = 1;
        $push->save();
//        $token = 'd24xG6D-i90:APA91bEMAJyv-NZAE3Et3utR0cKJajFhNIjrtY6vOVdcsOsilPWApPD8JX6s4aj3k3x9SEQRlXp4wRPkRQeuCQ9E3ZBeh3HTTuqI0gW8Ky9O3U5QEKJMjgvQ7Ny3wUORbHvGtYB5NJcB';
//        FCM::sendTo($token, $option, $notification, $dataBuild);
        Device::where('receiveNoti', 1)->chunk(50, function ($devices) use ($option, $notification, $dataBuild) {
            foreach ($devices as $device) {
                FCM::sendTo($device->token, $option, $notification, $dataBuild);
            }
        });
        Log::info(['end' => $push->id]);
    }
}
