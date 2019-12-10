<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pushs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pushs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pushs.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test2()
    {

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('三重最帥男人');
        $notificationBuilder->setBody('車神')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        //        $token = "APA91bFuc8025AfDfrd9xZP3C6O_YY1TSftGPacH-QJ26Byr5GvSjeO5xN9eRAyRDrdP86-sztHMeebXkACiiRggtwFxDWjTW6nf_1a5auSR9SIZcKV6_F1wFVwwTle8BJODvnKHEJB4y258kKK2BgKvyfHOuxlOrw";
        //        $token = "APA91bHIoQcSMSgFR4k50R6SoVrvTnYEtUMG4RxSzxLgm05TRBdewDQrteLRdDmfP2sW19T251oNj8NNF4bgEJzcUb4DKsW752BkTHLfwZIBxabignh1Ev9xfbkiDh3pvmhmpj_Xu7fS";
        //本機電腦token
        $token = "eSjPCLWxN78DxLEkZPIOAK:APA91bHIoQcSMSgFR4k50R6SoVrvTnYEtUMG4RxSzxLgm05TRBdewDQrteLRdDmfP2sW19T251oNj8NNF4bgEJzcUb4DKsW752BkTHLfwZIBxabignh1Ev9xfbkiDh3pvmhmpj_Xu7fS";
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        dd($downstreamResponse);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        dump($downstreamResponse->numberSuccess());
        dump($downstreamResponse->numberFailure());
        dump($downstreamResponse->numberModification());

        //        $notificationKey = [$token];
        //        AAAAcJcsleA:APA91bGF3zxtuvq2URRKlitCj8HzvMGVQCuZp_GyvM2pzA0tNh6peBpGLh1x_e7ZawUIXJjlCVahKU7FrOTpgTDQZGg4eDae5JrFi2WPH_MXtzk2X_zX_RuNnaqL0dSoIhz9jfJifxhm
        $notificationKey = ['APA91bFuc8025AfDfrd9xZP3C6O_YY1TSftGPacH-QJ26Byr5GvSjeO5xN9eRAyRDrdP86-sztHMeebXkACiiRggtwFxDWjTW6nf_1a5auSR9SIZcKV6_F1wFVwwTle8BJODvnKHEJB4y258kKK2BgKvyfHOuxlOrw'];
        //
        //
        $notificationBuilder = new PayloadNotificationBuilder('車神');
        $notificationBuilder->setBody('好帥')
            ->setSound('default');

        $notification = $notificationBuilder->build();


        $groupResponse = FCM::sendToGroup($notificationKey, null, $notification, null);

        $groupResponse->numberSuccess();
        $groupResponse->numberFailure();
        $groupResponse->tokensFailed();
        dump($groupResponse->numberSuccess());
        dump($groupResponse->numberFailure());
        dump($groupResponse->tokensFailed());
        dd($groupResponse);
        //        $optionBuilder = new OptionsBuilder();
        //        $optionBuilder->setTimeToLive(60*20);
        //
        //        $notificationBuilder = new PayloadNotificationBuilder('my title');
        //        $notificationBuilder->setBody('Hello world')
        //            ->setSound('default');
        //
        //        $dataBuilder = new PayloadDataBuilder();
        //        $dataBuilder->addData(['a_data' => 'my_data']);
        //
        //        $option = $optionBuilder->build();
        //        $notification = $notificationBuilder->build();
        //        $data = $dataBuilder->build();
        //
        //        $token = "APA91bFuc8025AfDfrd9xZP3C6O_YY1TSftGPacH-QJ26Byr5GvSjeO5xN9eRAyRDrdP86-sztHMeebXkACiiRggtwFxDWjTW6nf_1a5auSR9SIZcKV6_F1wFVwwTle8BJODvnKHEJB4y258kKK2BgKvyfHOuxlOrw";
        //        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        //        dd($downstreamResponse);

        //        $notificationBuilder = new PayloadNotificationBuilder();
        //        $notificationBuilder->setTitle('title')
        //            ->setBody('body')
        //            ->setSound('sound')
        //            ->setBadge('badge');
        //
        //        $notification = $notificationBuilder->build();
        //        dd($notification->send());
        $topics = new Topics();

        $topics->topic('TopicA')
            ->andTopic(function($condition) {
                $condition->topic('TopicB')->orTopic('TopicC');
            });

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
            ->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('news');
        $result = $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
        //dump($topicResponse->isSuccess());
        //                $topicResponse->isSuccess();
        //                $topicResponse->shouldRetry();
        //                $topicResponse->error();
        dump($result);
    }
}
