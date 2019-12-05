<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Models\Device;
use App\Models\News;
use App\Models\Program;
use App\Models\Push;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use wapmorgan\Mp3Info\Mp3Info;

class DownloadController extends Controller
{
    public function iosJson()
    {
        $headers = [
            'Content-Type' => 'application/pkcs7-mime',
        ];

//        dd(storage_path('app/json/apple-app-site-association'));
        return response()->download(storage_path('app/public/json/apple-app-site-association'), 'apple-app-site-association', $headers);
    }

    public function iosJsonDisplay()
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        //        dd(storage_path('app/json/apple-app-site-association'));
        return response()->download(storage_path('app/public/json/apple-app-site-association'), 'apple-app-site-association', $headers);
    }

    public function androidJson()
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        //        dd(storage_path('app/json/apple-app-site-association'));
        return response()->download(storage_path('app/public/json/assetlinks.json'), 'assetlinks.json', $headers);
    }
}
