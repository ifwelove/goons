<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        Log::info(date('Y-m-d H:i:s'));
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
