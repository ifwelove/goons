<?php

namespace App\Repositories;

use App\Models\Role;

class RolesRepository extends Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
