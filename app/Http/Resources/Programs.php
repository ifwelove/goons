<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Programs extends JsonResource
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
        $text = '';
        $type = $request->programType;
        switch ($type) {
            case 0:
                $text = '';
                break;
            case 1:
                $text = 'n';
                break;
            case 2:
                $text = 'o';
                break;
        }

        return [
            'id'        => (string) $text . $this->id,
            'title'     => str_replace($this->categories, '', $this->title),
            'subTitle'  => str_replace($this->category->title, '', $this->sub_title),
            'host'      => $this->anchor,
            //            'date' => $this->start_date,
            'date'      => Carbon::create($this->start_date)->timestamp,
            'length'    => is_null($this->duration) ? "" : $this->duration,
            'playerURL' => str_replace(' ', '%20', str_replace('s//o', 's/o', $this->url)),
            'shareURL'  => config('app.link_url') . '/' . $request->programType . '/' . $this->categories . '/' . $text . $this->id,
            'shareText' => '快來聽聽看「' . $this->category->title . ' ' . $this->title . '」請先下載ＡＰＰ，讓您收聽節目笑咪咪～',
        ];
    }
}
