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
            return $q->where('start_date', '>=', Carbon::parse($start_date)->startOfDay())
                ->Where('start_date', '<=', Carbon::parse($start_date)->endOfDay());
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
        $push = Push::create($request->all());

        return $push;
    }

    public function pushDestroy($id)
    {
        $result = Push::destroy($id);

        return $result;
    }

    public function pushUpdate($id, $request)
    {
        $push = Push::findOrFail($id);
        $push->update($request->all());

        return true;
    }

}
