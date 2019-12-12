<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramsCollection extends ResourceCollection
{
    private $pagination;
    private $programName;

    public function __construct($resource, $programName = '')
    {
        $this->pagination = [
            'page'  => $resource->currentPage(),
            'totalPage'  => $resource->lastPage(),
        ];
        $this->programName = $programName;
        $resource = $resource->getCollection();

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
            'page'  => $this->pagination['page'],
            'totalPage'  => $this->pagination['totalPage'],
            'programName'  => $this->programName,
            'sysCode' => 200,
            'sysMsg'  => ""
        ];
    }
}
