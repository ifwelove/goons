<?php

namespace App\Console\Commands;

use App\Jobs\Mp3QueryJob;
use App\Models\BibleNewProgram;
use App\Models\BibleProgram;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use wapmorgan\Mp3Info\Mp3Info;

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
//        dispatch(new Mp3QueryJob());
    }

    public function setDuration()
    {
//        $programs = BibleProgram::where('duration', '')->get();
//        $programs = BibleNewProgram::where('duration', '')->get();
//        foreach ($programs as $program) {
//            $formatUrl = str_replace(' ', '%20', str_replace('//o', '/o', $program->url));
//            $aa = explode('/', $formatUrl);
//            $fileName = end($aa);
//            $fileLocal = storage_path('app/public/mp3/' . $fileName);
//            if (!file_exists( $fileLocal)) {
//                dump($program->id . ':' . $fileName);
//            } else {
//                $audio = new Mp3Info($fileLocal);
//                $program->duration = intval($audio->duration);
//                $program->save();
//            }
//        }
    }
}
