<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Categories extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $weekList = array('日', '一', '二', '三', '四', '五', '六');
        $week = $weekList[Carbon::create($this->start_date)->dayOfWeek];
        $format = 'Y/m/d (' . $week . ')';

        return [
            'id'       => $this->id,
            'title'       => $this->category->title,
            'subTitle' => $this->title,
//            'date'        => $this->start_date,
            'date'        => Carbon::create($this->start_date)->timestamp,
            'dateFormat'        => Carbon::create($this->start_date)->format($format),
            'imageURL'    => $this->category->image,
        ];
    }
}
