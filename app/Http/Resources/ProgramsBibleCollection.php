<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramsBibleCollection extends ResourceCollection
{
    private $programName;

    public function __construct($resource)
    {
        $this->programName = $resource->first()
            ->toArray()['category']['title'];

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }

    public function with($request)
    {
        return [
            'programName' => $this->programName,
            'sysCode'     => 200,
            'sysMsg'      => ""
        ];
    }
}
