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
        switch ($request->programType){
            case 0:
                $id = $this->id;
                break;
            case 1:
                $id = 'n' . $this->id;
                break;
            case 2:
                $id = 'o' . $this->id;
                break;
        }
        $weekList = array('日', '一', '二', '三', '四', '五', '六');
        $week = $weekList[Carbon::create($this->start_date)->dayOfWeek];
        $format = 'Y/m/d (' . $week . ')';
        $result = [
            'id'       => $id,
            'title'       => $this->category->title,
            'subTitle' => $this->title,
            //            'date'        => $this->start_date,
            'date'        => Carbon::create($this->start_date)->timestamp,
            'dateFormat'        => Carbon::create($this->start_date)->format($format),
            'imageURL'    => $this->category->image,
            'categoryId'    => $this->category->id,
            'programType'    => $request->programType,
        ];

        return $result;
    }
}
