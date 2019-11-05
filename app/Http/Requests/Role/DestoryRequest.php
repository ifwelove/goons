<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BasicRequest;
use App\Repositories\RolesRepository;

class DestoryRequest extends BasicRequest
{
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function authorize()
    {
        return $this->rolesRepository->find($this->route('role'));
    }

    public function rules()
    {
        return [];
    }
}
