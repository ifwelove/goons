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

class CronController extends Controller
{

    public function mp3()
    {
        $program = Program::whereNull('duration')->first();
        if (is_null($program)) {
            return response()->json();
        }

        ini_set('memory_limit', '2048M');
        ignore_user_abort(true);
        set_time_limit(1200);

        $formatUrl = str_replace(' ', '%20', str_replace('//o', '/o', $program->url));
        $aa = explode('/', $formatUrl);
        $fileName = end($aa);
        if (!Str::contains($fileName, ['.mp3', '.mp4'])) {
            $program->duration = '0';
            $program->save();
        } else {
            $fileLocal = storage_path('app/public/music/' . $fileName);
            $fileUrl = $formatUrl;
            $result = file_put_contents($fileLocal, fopen($fileUrl, 'r'));
            if ($result <= 0 && !file_exists($fileLocal)) {
            } else {
                $audio = new Mp3Info($fileLocal);
                $program->duration = intval($audio->duration);
                $program->save();
                unlink($fileLocal);
            }
        }
        Log::info($program->toArray());

        return response()->json();
    }

    public function news()
    {
//        return response()->json();

        $news = News::where('type', 0)->where('auto_push', 1)->where('start_date', '<=', Carbon::now())->first();
        if (is_null($news)) {
            return response()->json();
        }
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        //notification
        $notificationBuilder = new PayloadNotificationBuilder('遠東福音會');
        $notificationBuilder->setBody($news->title)->setSound('default');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = ['a_data' => $news->title];
        $dataBuilder = new PayloadDataBuilder();
        //android, web
//        $dataBuilder->addData($data);//key and value
        //ios
        $dataBuilder->addData([
            'custom' => $data
        ]);
        $data = $dataBuilder->build();
        Device::chunk(50, function ($devices) use ($option, $notification, $data) {
            foreach ($devices as $device) {
                FCM::sendTo($device->token, $option, $notification, $data);
            }
        });
        $news->type = 1;
        $news->save();
        Log::info($news->toArray());

        return response()->json();
    }

    public function pushs()
    {
        //@立即推播status=1 and type=0
        $nowPush = Push::where('type', 0)->where('status', 1)->first();
        //@預約推播status=0 and type=0 and start_date 等於預約時間,
        $orderPush = Push::where('type', 0)->where('status', 0)->where('start_date', '<=', Carbon::now())->first();
        if (is_null($orderPush) && is_null($nowPush)) {
            return response()->json();
        }
        if (!is_null($nowPush)) {
            $push = $nowPush;
        }
        if (!is_null($orderPush)) {
            $push = $orderPush;
        }
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        //notification
        $notificationBuilder = new PayloadNotificationBuilder($push->title);
        $notificationBuilder->setBody($push->sub_title)->setSound('default');

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        Device::chunk(50, function ($devices) use ($option, $notification) {
            foreach ($devices as $device) {
                FCM::sendTo($device->token, $option, $notification);
            }
        });
        //@todo ios android
//        $devices = Device::all();
//        foreach ($devices as $device) {
//            FCM::sendTo($device->token, $option, $notification);
//        }
        $push->type = 1;
        $push->save();
        Log::info($push->toArray());

        return response()->json();
    }

    public function pushByCurl()
    {
        //只有notification 沒有data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //小窗
//        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"notification\": {\n    \"title\": \"三重最帥男人\", \n    \"body\": \"車神\"\n  },\n  \"to\": \"eSjPCLWxN78DxLEkZPIOAK:APA91bHIoQcSMSgFR4k50R6SoVrvTnYEtUMG4RxSzxLgm05TRBdewDQrteLRdDmfP2sW19T251oNj8NNF4bgEJzcUb4DKsW752BkTHLfwZIBxabignh1Ev9xfbkiDh3pvmhmpj_Xu7fS\"\n}");
        //瀏覽器
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"notification\": {\n    \"title\": \"三重最帥男人\", \n    \"body\": \"車神\"\n  },\n  \"to\": \"e1e_Xn1XZ3T1iXuczdMlLf:APA91bEKPrNsh6zpg0j1FMHvqb0HgIolicjkGzhYctRVRKu-c7o00R6_4unenFF67UFmYSa7vsgbd8oPY9E1wHZlu3PE6exOvEJkv4ghyGkaKjz4uu3W6duPvz3MPV-gTw2dEm5y1kQE\"\n}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Authorization: key=AAAAcJcsleA:APA91bGF3zxtuvq2URRKlitCj8HzvMGVQCuZp_GyvM2pzA0tNh6peBpGLh1x_e7ZawUIXJjlCVahKU7FrOTpgTDQZGg4eDae5JrFi2WPH_MXtzk2X_zX_RuNnaqL0dSoIhz9jfJifxhm';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

    }

    public function pushByFcm()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        //notification
        $notificationBuilder = new PayloadNotificationBuilder('三重最帥男人');
        $notificationBuilder->setBody('車神')
            ->setSound('default');

        //data
        $data = ['a_data' => 'my_data'];
        $dataBuilder = new PayloadDataBuilder();
        //android, web
        $dataBuilder->addData($data);//key and value
        //ios
//        $dataBuilder->addData([
//            'custom' => $data //sending custom data
//        ]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        //本機電腦token
        $token = "e1e_Xn1XZ3T1iXuczdMlLf:APA91bEKPrNsh6zpg0j1FMHvqb0HgIolicjkGzhYctRVRKu-c7o00R6_4unenFF67UFmYSa7vsgbd8oPY9E1wHZlu3PE6exOvEJkv4ghyGkaKjz4uu3W6duPvz3MPV-gTw2dEm5y1kQE";
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
//        dump($downstreamResponse);
        //本機外掛小窗token
        $token = "eSjPCLWxN78DxLEkZPIOAK:APA91bHIoQcSMSgFR4k50R6SoVrvTnYEtUMG4RxSzxLgm05TRBdewDQrteLRdDmfP2sW19T251oNj8NNF4bgEJzcUb4DKsW752BkTHLfwZIBxabignh1Ev9xfbkiDh3pvmhmpj_Xu7fS";
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
//        dump($downstreamResponse);
    }
}
