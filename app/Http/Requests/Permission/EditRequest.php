<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\BasicRequest;
use App\Repositories\PermissionsRepository;

class EditRequest extends BasicRequest
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
        return [];
    }
}
