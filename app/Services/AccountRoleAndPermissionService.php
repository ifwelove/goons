<?php

namespace App\Services;

use App\Repositories\RolesRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\AccountsRepository;
use App\User;

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

    public function accountPaginate($perPage = null, $keyword = null)
    {
        if (is_null($perPage)) {
            $perPage = 10;
        }

        if (is_null($keyword)) {
            $accounts = User::orderBy('id', 'desc')->paginate($perPage);
        } else {
            $accounts = User::where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                ->orderBy('id', 'desc')
                ->paginate($perPage);
        }

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
        $account = User::with('roles')->find($id);
//        $account = $this->accountsRepository->find($id);

        return $account;
    }

    public function accountStore($request)
    {
        $inputs = [];
        $email = $request->get('email', null);
        $name = $request->get('name', null);
        $password = $request->get('password', null);
        $inputs['email'] = $email;
        $inputs['name'] = $name;
        $inputs['password'] = bcrypt($password);
        $account = $this->accountsRepository->create($inputs);
        $roles   = $request['roles'];
        if (isset($roles)) {
            $account->roles()->sync($roles);
        } else {
            $account->roles()->detach();
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
        $inputs = [];
        $account = $this->accountFind($id);
        $name = $request->get('name', null);
        $password = $request->get('password', null);
        if (!is_null($name)) {
            $inputs['name'] = $name;
        }
        if (!is_null($password)) {
            $inputs['password'] = bcrypt($password);
        }
        if (!empty($inputs)) {
            $this->accountsRepository->update($id, $inputs);
        }
        $roles    = $request['roles'];
        if (isset($roles)) {
            $account->roles()->sync($roles);
        } else {
            $account->roles()->detach();
        }

        return true;
    }

    public function accountStatusUpdate($id, $request)
    {
        $inputs = [];
        $status = $request->get('status', null);
        if (!is_null($status)) {
            $inputs['status'] = $status;
        }
        if (!empty($inputs)) {
            $this->accountsRepository->update($id, $inputs);
        }

        return true;
    }
}
