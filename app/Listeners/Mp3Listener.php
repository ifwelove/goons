<?php

namespace App\Listeners;

use App\Events\Mp3Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mp3Listener implements ShouldQueue
{
    public $queue = 'mp3';

    public function __construct()
    {
    }

    public function handle(Mp3Event $event)
    {
//        $fileName = 'test1.mp3';
//        $fileLocal = storage_path('app/public/mp3/' . $fileName);
//        $fileUrl = ('http://media.feearadio.net/downloads/program/BH/bh-191108.mp3');
//        dump('下載:');
//        $result = file_put_contents($fileLocal, fopen($fileUrl, 'r'));
//        dump('下載完成:');
//        dump($result);

        ini_set('memory_limit', '2048M');
        ignore_user_abort(true);
        set_time_limit(1200);

        $formatUrl = str_replace(' ', '%20', str_replace('//o', '/o', $event->program->url));
        $aa = explode('/', $formatUrl);
        $fileName = end($aa);
        $fileLocal = storage_path('app/public/mp3/' . $fileName);
        $fileUrl = $formatUrl;
////        $fileName = 'http://media.feearadio.net/downloads/program/BH/bh-191108.mp3';
        dump('下載:' . $formatUrl);
        $result = file_put_contents($fileLocal, fopen($fileUrl, 'r'));
        dump('下載完成:' . $event->program->id);
        sleep(rand(1, 5));
    }
}
