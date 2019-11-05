<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\BasicRequest;
use App\Repositories\PermissionsRepository;

class UpdateRequest extends BasicRequest
{
    private $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function authorize()
    {
        return $this->permissionsRepository->find($this->route('permission'));
    }

    public function rules()
    {
        $id = $this->permission;

        return [
            'name' => 'required|max:255|unique:permissions,name,' . $id,
            'slug' => 'required|max:64|unique:permissions,slug,' . $id,
        ];
    }
}
