<?php

namespace App\Services;

use App\Models\News;
use Carbon\Carbon;

class NewsService
{

    public function __construct()
    {
    }

    public function newsPaginate($perPage = null, $title = null, $status = null, $start_date = null)
    {
        if (is_null($perPage)) {
            $perPage = 10;
        }
        $query = News::query();
        $query->when(! is_null($title), function ($q) use ($title) {
            return $q->where('title', 'LIKE', '%' . $title . '%');
        });
        switch ($status) {
            case null:
                break;
            case 0:
                $query->where('end_date', '<', Carbon::now());
                break;
            case 1:
                $query->where('start_date', '<=', Carbon::now());
                $query->where('end_date', '>=', Carbon::now());
                break;
            case 2:
                $query->where('start_date', '>=', Carbon::now());
                break;
        }
        $query->when(! is_null($start_date), function ($q) use ($start_date) {
            return $q->where('start_date', '>=', Carbon::parse($start_date)->startOfDay())
                ->Where('start_date', '<=', Carbon::parse($start_date)->endOfDay());
        });
        $news = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        return $news;
    }

    public function newsFind($id)
    {
        $news = News::find($id);

        return $news;
    }

    public function newsStore($request)
    {
        $news = News::create($request->all());

        return $news;
    }

    public function newsDestroy($id)
    {
        $result = News::destroy($id);

        return $result;
    }

    public function newsUpdate($id, $request)
    {
        $news = News::findOrFail($id);
        $news->update($request->all());

        return true;
    }

}