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
        switch ($request->get('firstClase')) {
            case 'A':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                    'secClase'   =>  $request->get('secClase', ''),
                ];
                break;
            case 'B':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                ];
                break;
            case 'C':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                ];
                break;
            case 'D':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                    'secClase'   => $request->get('secClase', ''),
                    'lastClase'   => $request->get('lastClase', ''),
                ];
                break;

        }
        $push            = new Push;
        $push->title     = $request->get('title', "");
        $push->sub_title = $request->get('sub_title', "");
        $push->status    = $request->get('status', 0);
        $push->url        = json_encode($data);
        $push->start_date = $request->get('start_date', "");
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
        switch ($request->get('firstClase')) {
            case 'A':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                    'secClase'   =>  $request->get('secClase', ''),
                ];
                break;
            case 'B':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                ];
                break;
            case 'C':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                ];
                break;
            case 'D':
                $data            = [
                    'firstClase' => $request->get('firstClase'),
                    'secClase'   => $request->get('secClase', ''),
                    'lastClase'   => $request->get('lastClase', ''),
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
