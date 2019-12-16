<?php

namespace App\Services;

use App\Models\Push;
use Carbon\Carbon;

class PushService
{

    public function __construct()
    {
    }

    public function pushPaginate($perPage = null, $keyword = null, $status = null, $start_date = null)
    {
        if (is_null($perPage)) {
            $perPage = 10;
        }
        $query = Push::query();
        $query->when(! is_null($keyword), function ($q) use ($keyword) {
            return $q->where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('sub_title', 'LIKE', '%' . $keyword . '%');
        });
        switch ($status) {
            case null:
                break;
            case 0:
                $query->where('status', 0);
                break;
            case 1:
                $query->where('status', 1);
                break;
        }
        $query->when(! is_null($start_date), function ($q) use ($start_date) {
            return $q->where('start_date', '>=', Carbon::parse($start_date)
                ->startOfDay())
                ->Where('start_date', '<=', Carbon::parse($start_date)
                    ->endOfDay());
        });
        $push = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        return $push;
    }

    public function pushFind($id)
    {
        $push = Push::find($id);

        return $push;
    }

    public function pushStore($request)
    {
        switch ($request->get('firstClass')) {
            case 'A':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                    'secClass'   =>  $request->get('secClass', ''),
                ];
                break;
            case 'B':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                ];
                break;
            case 'C':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                ];
                break;
            case 'D':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                    'secClass'   => $request->get('secClass', ''),
                    'lastClass'   => $request->get('lastClass', ''),
                ];
                break;

        }
        $push            = new Push;
        $status = $request->get('status', 0);
        if ($status) {
            $push->start_date = Carbon::now();
        } else {
            $push->start_date = $request->get('start_date', "");
        }
        $push->title     = $request->get('title', "");
        $push->sub_title = $request->get('sub_title', "");
        $push->status    = $status;
        $push->url        = json_encode($data);
        $push->save();

        return $push;
    }

    public function pushDestroy($id)
    {
        $result = Push::destroy($id);

        return $result;
    }

    public function pushUpdate($id, $request)
    {
        switch ($request->get('firstClass')) {
            case 'A':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                    'secClass'   =>  $request->get('secClass', ''),
                ];
                break;
            case 'B':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                ];
                break;
            case 'C':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                ];
                break;
            case 'D':
                $data            = [
                    'firstClass' => $request->get('firstClass'),
                    'secClass'   => $request->get('secClass', ''),
                    'lastClass'   => $request->get('lastClass', ''),
                ];
                break;

        }
        $push = Push::findOrFail($id);
        $push->title     = $request->get('title', "");
        $push->sub_title = $request->get('sub_title', "");
        $push->status    = $request->get('status', 0);
        $push->url        = json_encode($data);
        $push->start_date = $request->get('start_date', "");
        $push->save();

        return true;
    }

}
