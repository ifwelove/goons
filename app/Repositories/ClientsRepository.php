<?php

namespace App\Repositories;

use App\Models\Client;

class ClientsRepository extends Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param Client $model
     */
    public function __construct(Client $model)
    {
        $this->model = $model;
    }
}
