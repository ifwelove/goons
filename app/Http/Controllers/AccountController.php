<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\DestoryRequest;
use App\Http\Requests\Account\EditRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Http\Requests\Request;
use App\Http\Resources\AccountPaginatedCollection;
use App\Models\SysAdmin;
use App\Services\AccountRoleAndPermissionService;

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

        return view('accounts.index')->with('accounts', $accounts);
    }

    public function create()
    {
        $roles = $this->accountRoleAndPermissionService->roleAll();

        return view('accounts.create', ['roles' => $roles]);
    }

    public function store(StoreRequest $request)
    {
        $this->accountRoleAndPermissionService->accountStore($request);

        return redirect()
            ->route('accounts.index')
            ->withSuccess('backend.message.account_successfully_created');
    }

    public function show($id)
    {
        return redirect('accounts');
    }

    public function edit(EditRequest $request, $id)
    {
        $roles = $this->accountRoleAndPermissionService->roleAll();
        $account  = $this->accountRoleAndPermissionService->accountFind($id);

        return view('accounts.edit', compact('account', 'roles')); // 将用户和角色数据传递到视图

    }

    public function update(UpdateRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->accountUpdate($id, $request);

        return redirect()
            ->route('accounts.index')
            ->withSuccess('backend.message.account_successfully_updated');
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->accountDestroy($id);

        return redirect()
            ->route('accounts.index')
            ->withSuccess('backend.message.account_successfully_deleted');
    }
}
