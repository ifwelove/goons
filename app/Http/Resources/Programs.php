<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Programs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'subTitle' => $this->sub_title,
            'host' => $this->anchor,
            'date' => $this->start_date,
            'length' => $this->duration,
            'playerURL' => $this->url,
            'shareURL' => config('app.url') . '/share/' . $this->id,
            'shareText' => $this->title . '一起來收聽吧',
        ];
    }
}
