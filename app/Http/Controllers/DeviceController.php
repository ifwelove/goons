<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Resources\Device as DeviceResource;

class DeviceController extends Controller
{

    public function setTokenApi(Request $request)
    {
        $input = $request->only(['Device', 'DeviceToken']);
        $device = Device::updateOrCreate(['token' => $input['DeviceToken']], [
            'type'  => $input['Device'],
            'token' => $input['DeviceToken']
        ]);
        DeviceResource::withoutWrapping();

        return new DeviceResource($device);
    }
}
