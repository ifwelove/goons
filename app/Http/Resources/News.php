<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'title' => $this->title,
                        'date' => '2019-11-30',
            //            'start_date' => $this->start_date,
            //            'end_date' => $this->end_date,
                        'moreURL' => 'https://yahoo.com.tw',
            'id' => $this->id,
        ];
    }
}
