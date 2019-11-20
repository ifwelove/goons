<?php

namespace App\Console\Commands;

use App\Jobs\Mp3QueryJob;
use App\Models\BibleNewProgram;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class Mp3QueryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mp3:parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mp3';

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
//                $fileName = 'test1.mp3';
//                $fileLocal = storage_path('app/public/mp3/' . $fileName);
////                $fileUrl = 'http://media.feearadio.net/downloads/program/BH/bh-191108.mp3';
//                $fileUrl = str_replace(' ', '%20','http://media.feearadio.net/downloads/others/Union Version Bible/01 Matthew/Mat01.mp3');
////                $fileUrl = 'http://media.feearadio.net/downloads/others/Union%20Version%20Bible/01%20Matthew/Mat01.mp3';
//                dump('下載:');
//                $result = file_put_contents($fileLocal, fopen($fileUrl, 'r'));
//                dump('下載完成:');
//                dump($result);
        dispatch(new Mp3QueryJob());
    }
}
