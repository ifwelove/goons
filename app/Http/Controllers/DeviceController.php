<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Resources\Device as DeviceResource;

class DeviceController extends Controller
{

    public function setTokenApi(Request $request)
    {
        $input = $request->only(['device', 'deviceToken', 'receiveNoti']);
        $device = Device::updateOrCreate(['token' => $input['deviceToken']], [
            'type'  => $input['device'],
            'token' => $input['deviceToken'],
            'receiveNoti' => $input['receiveNoti']
        ]);
        DeviceResource::withoutWrapping();

        return new DeviceResource($device);
    }
}
