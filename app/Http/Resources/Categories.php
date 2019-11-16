<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id'       => $this->id,
            'title'       => $this->title,
            'subTitle' => $this->sub_title,
            'date'        => $this->start_date,
            'imageURL'    => $this->image,
        ];
    }
}
