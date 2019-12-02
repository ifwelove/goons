<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'title'       => $this->title,
            'description' => $this->sub_title,
            'host'        => $this->anchor,
            'imageURL'    => config('app.url') . $this->image,
            'sysCode'     => 200,
            'sysMsg'     => '',
        ];
    }
}
