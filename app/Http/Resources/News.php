<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
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
        //        return parent::toArray($request);
        return [
            'id'         => $this->id,
            'title'      => $this->title,
//            'date'       => $this->start_date,
            'date'        => Carbon::create($this->start_date)->timestamp,
            'dateFormat' => Carbon::create($this->start_date)->format('Y/m/d'),
            //            'start_date' => $this->start_date,
            //            'end_date' => $this->end_date,
            'moreURL'    => config('app.url') . '/news/' . $this->id,
        ];
    }
}
