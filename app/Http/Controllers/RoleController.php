<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\DestoryRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Services\AccountRoleAndPermissionService;

class RoleController extends Controller
{
    private $accountRoleAndPermissionService;

    public function __construct(AccountRoleAndPermissionService $accountRoleAndPermissionService)
    {
        $this->accountRoleAndPermissionService = $accountRoleAndPermissionService;
    }

    public function index()
    {
        $roles = $this->accountRoleAndPermissionService->roleAll();

        return view('roles.index')->with('roles', $roles);
    }

    public function create()
    {
        $permissions = $this->accountRoleAndPermissionService->permissionAll();

        return view('roles.create', ['permissions' => $permissions]);
    }

    public function store(StoreRequest $request)
    {
        $this->accountRoleAndPermissionService->roleStore($request);

        return redirect()
            ->route('roles.index')
            ->withSuccess('backend.message.role_successfully_created');
    }

    public function show($id)
    {
        return redirect('roles');
    }

    public function edit($id)
    {
        $role        = $this->accountRoleAndPermissionService->roleFind($id);
        $permissions = $this->accountRoleAndPermissionService->permissionAll();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->roleUpdate($id, $request);

        return redirect()
            ->route('roles.index')
            ->withSuccess('backend.message.role_successfully_updated');
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $result = $this->accountRoleAndPermissionService->roleDestroy($id);

        if ($result) {
            return redirect()
                ->route('roles.index')
                ->withSuccess('backend.message.role_successfully_deleted');
        } else {
            return redirect()
                ->route('roles.index')
                ->with('error', 'backend.message.role_failed_to_delete');
        }
    }
}
