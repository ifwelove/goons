<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\DestoryRequest;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Services\AccountRoleAndPermissionService;

class PermissionController extends Controller
{
    private $accountRoleAndPermissionService;

    public function __construct(AccountRoleAndPermissionService $accountRoleAndPermissionService)
    {
        $this->accountRoleAndPermissionService = $accountRoleAndPermissionService;
    }

    public function index()
    {
        $permissions = $this->accountRoleAndPermissionService->permissionAll();

        return view('permissions.index')->with('permissions', $permissions);
    }

    public function create()
    {
        $roles = $this->accountRoleAndPermissionService->roleAll();

        return view('permissions.create')->with('roles', $roles);
    }

    public function store(StoreRequest $request)
    {
        $this->accountRoleAndPermissionService->permissionStore($request);

        return redirect()
            ->route('permissions.index')
            ->withSuccess('backend.message.permission_successfully_created');
    }

    public function show($id)
    {
        return redirect('permissions');
    }

    public function edit($id)
    {
        $roles      = $this->accountRoleAndPermissionService->roleAll();
        $permission = $this->accountRoleAndPermissionService->permissionFind($id);

        return view('permissions.edit', compact('roles', 'permission'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->permissionUpdate($id, $request);
        $this->accountRoleAndPermissionService->permissionFind($id);

        return redirect()
            ->route('permissions.index')
            ->withSuccess('backend.message.permission_successfully_updated');
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->permissionDestroy($id);

        return redirect()
            ->route('permissions.index')
            ->withSuccess('backend.message.permission_successfully_deleted');
    }
}
