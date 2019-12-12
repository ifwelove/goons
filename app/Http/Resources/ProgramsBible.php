<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramsBible extends JsonResource
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
            'title'     => $this->title,
            'subTitle'  => $this->sub_title,
            'host'      => $this->anchor,
            //            'date' => $this->start_date,
            'date'      => Carbon::create($this->start_date)->timestamp,
            'length'    => is_null($this->duration) ? "" : $this->duration,
            'playerURL' => str_replace(' ', '%20', str_replace('s//o', 's/o', $this->url)),
            'shareURL'  => config('app.link_url') . '/' . $request->programType . '/' . $this->categories . '/' . $text . $this->id,
            'shareText' => $this->title . '一起來收聽吧',
        ];
    }
}
