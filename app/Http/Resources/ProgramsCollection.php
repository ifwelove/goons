<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramsCollection extends ResourceCollection
{
    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'page'  => $resource->currentPage(),
            'totalPage'  => $resource->lastPage(),
        ];

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
            'sysCode' => 200,
            'sysMsg'  => ""
        ];
    }
}
