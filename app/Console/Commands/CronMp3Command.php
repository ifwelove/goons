<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\News;
use App\Models\Program;
use App\Models\Push;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use wapmorgan\Mp3Info\Mp3Info;

class CronMp3Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:mp3';

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

        $program = Program::whereNull('duration')
            ->first();
        if (is_null($program)) {
            Log::info(['mp3']);
            dd('exit');
        }
        Log::info(['start' => $program->id]);
        $formatUrl = str_replace(' ', '%20', str_replace('//o', '/o', $program->url));
        $aa        = explode('/', $formatUrl);
        $fileName  = end($aa);
        if (! Str::contains($fileName, ['.mp3', '.mp4'])) {
            $program->duration = '0';
            $program->save();
        } else {
            $fileLocal = storage_path('app/public/music/' . $fileName);
            $fileUrl   = $formatUrl;
            try {
                $result    = file_put_contents($fileLocal, fopen($fileUrl, 'r'));
                if ($result <= 0 && ! file_exists($fileLocal)) {
                } else {
                    $audio             = new Mp3Info($fileLocal);
                    $program->duration = intval($audio->duration);
                    $program->save();
                    unlink($fileLocal);
                }
            } catch (\Exception $e) {
                $program->duration = '0';
                $program->save();
            }
        }
        Log::info(['end' => $program->id]);
    }
}
