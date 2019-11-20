<?php

namespace App\Services;

use App\Events\Mp3Event;
use App\Models\BibleNewProgram;
use App\Models\BibleProgram;

class Mp3
{
    public function __construct()
    {
        ini_set('memory_limit', '4096M');
        ignore_user_abort(true);
        set_time_limit(0);
    }

    public function run()
    {
        dump('add event');
        $programs = BibleProgram::where('duration', '')->get();
        foreach ($programs as $program) {
            event(new Mp3Event($program));
//            break;
        }

//        Property::where('mobile', '')->where('mobile_img', '!=', '')->chunk(100, function ($properties) {
////            dump(1);
//            $properties->each(function ($property, $key) {
//                dump($key);
//                event(new ParseImageEvent($property));
//            });
////            dump(2);
//        });
        dump('end event');
    }

    public function getParseResult($fileName = null)
    {
        return $this->parseFile($fileName);
    }

    private function parseFile($fileName)
    {
        $response = (new TesseractOCR($fileName))->run();
        $mobile = preg_replace('/\s(?=)/', '', $response);

        return $mobile;
    }

    public function saveFile($url = null, $fileName = null)
    {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' =>
                    "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36\r\n",
                'timeout' => 300,
            )
        );
        $context = stream_context_create($opts);
        $content = file_get_contents($url,
            false, $context);
        file_put_contents($fileName, $content);
    }
}
