<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\BasicRequest;
use App\Repositories\PermissionsRepository;

class StoreRequest extends BasicRequest
{
    private $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:permissions,name',
            'slug' => 'required|max:64|unique:permissions,slug',
        ];
    }
}
