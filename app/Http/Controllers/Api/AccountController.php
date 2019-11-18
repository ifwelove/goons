<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Account\DestoryRequest;
use App\Http\Requests\Account\EditRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Services\AccountRoleAndPermissionService;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    private $accountRoleAndPermissionService;

    public function __construct(AccountRoleAndPermissionService $accountRoleAndPermissionService)
    {
        $this->accountRoleAndPermissionService = $accountRoleAndPermissionService;
    }

    public function index()
    {
        $accounts = $this->accountRoleAndPermissionService->accountPaginate();

        return response()->json($accounts);
    }

    public function create()
    {
        $roles = $this->accountRoleAndPermissionService->roleAll();

        return response()->json($roles);
    }

    public function store(StoreRequest $request)
    {
        $this->accountRoleAndPermissionService->accountStore($request);

        return response()->json(['message' => '新增成功']);
    }

    public function edit(EditRequest $request, $id)
    {
        $roles   = $this->accountRoleAndPermissionService->roleAll();
        $account = $this->accountRoleAndPermissionService->accountFind($id);

        return response()->json([
            'roles'   => $roles,
            'account' => $account,
        ]);

    }

    public function update(UpdateRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->accountUpdate($id, $request);

        return response()->json(['message' => '編輯成功']);
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->accountDestroy($id);

        return response()->json(['message' => '刪除成功']);
    }

    public function updateStatus()
    {
//        dd('updateStatus');
        return response()->json(['message' => '更新成功']);
    }

}
