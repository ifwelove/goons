<?php

namespace App\Services;

use App\Repositories\RolesRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\AccountsRepository;

class AccountRoleAndPermissionService
{
    private $rolesRepository;
    private $permissionsRepository;
    private $accountsRepository;

    public function __construct(RolesRepository $rolesRepository, PermissionsRepository $permissionsRepository, AccountsRepository $accountsRepository)
    {
        $this->rolesRepository       = $rolesRepository;
        $this->permissionsRepository = $permissionsRepository;
        $this->accountsRepository    = $accountsRepository;
    }

    public function permissionAll()
    {
        $permissions = $this->permissionsRepository->all();

        return $permissions;
    }

    public function roleAll()
    {
        $roles = $this->rolesRepository->all();

        return $roles;
    }

    public function accountAll()
    {
        $accounts = $this->accountsRepository->all();

        return $accounts;
    }

    public function accountPaginate($perPage = null)
    {
        if (is_null($perPage)) {
            $perPage = 10;
        }

        $accounts = $this->accountsRepository->paginate($perPage);

        return $accounts;
    }

    public function permissionFind($id)
    {
        $permission = $this->permissionsRepository->find($id);

        return $permission;
    }

    public function permissionStore($request)
    {
        $name   = $request['name'];
        $slug   = $request['slug'];
        $roles  = $request['roles'];
        $result = $this->permissionsRepository->create($request->only('name', 'slug'));

        if (! empty($request['roles'])) {
            foreach ($roles as $id) {
                $permission = $this->permissionsRepository->findBy('name', $name);
                $r          = $this->roleFind($id);

                $r->givePermissionTo($permission);
            }
        }

        return $result;
    }

    public function permissionUpdate($id, $request)
    {
        $result     = $this->permissionsRepository->update($id, $request->only('name', 'slug'));
        $permission = $this->permissionsRepository->find($id);
        $roles      = $this->roleAll();

        foreach ($roles as $role) {
            if (! empty($request['roles']) AND in_array($role->id, $request['roles'])) {
                $role->givePermissionTo($permission);
            } else {
                $role->revokePermissionTo($permission);
            }
        }

        return $result;
    }

    public function permissionDestroy($id)
    {
        $result = $this->permissionsRepository->destroy($id);

        return $result;
    }

    public function roleFind($id)
    {
        $role = $this->rolesRepository->find($id);

        return $role;
    }

    public function roleStore($request)
    {
        $name        = $request['name'];
        $permissions = $request['permissions'] ? $request['permissions'] : [];
        $result      = $this->rolesRepository->create($request->only('name'));

        foreach ($permissions as $id) {
            $p    = $this->permissionFind($id);
            $role = $this->rolesRepository->findBy('name', $name);

            $role->givePermissionTo($p);
        }

        return $result;
    }

    public function roleUpdate($id, $request)
    {
        $permissions = $request['permissions'] ? $request['permissions'] : [];
        $result      = $this->rolesRepository->update($id, $request->only('name'));
        $role        = $this->roleFind($id);
        $p_all       = $this->permissionAll();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        foreach ($permissions as $id) {
            $p = $this->permissionFind($id);

            $role->givePermissionTo($p);
        }

        return $result;
    }

    public function roleDestroy($id)
    {
        $role = $this->roleFind($id);

        if ($role->name === "admin") {
            return false;
        }

        $result = $this->rolesRepository->destroy($id);

        return $result;
    }

    public function accountFind($id)
    {
        $account = $this->accountsRepository->find($id);

        return $account;
    }

    public function accountStore($request)
    {
        $account = $this->accountsRepository->create($request->only('email', 'name', 'password'));
        $roles   = $request['roles'];

        if (isset($roles)) {
            foreach ($roles as $id) {
                $role_r = $this->roleFind($id);

                $account->assignRole($role_r);
            }
        }

        return $account;
    }

    public function accountDestroy($id)
    {
        $result = $this->accountsRepository->destroy($id);

        return $result;
    }

    public function accountUpdate($id, $request)
    {
        $account = $this->accountFind($id);
        $role    = $request['role'];

        if (isset($role)) {
            $account->roles()->sync($role);
        } else {
            $account->roles()->detach();
        }

        return true;
    }
}
