<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionsRepository extends Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function findWithName($name)
    {
        $permission = Permission::where('name', '=', $name)->first();

        return $permission;
    }
}
