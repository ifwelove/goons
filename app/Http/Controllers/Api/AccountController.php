<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Account\DestoryRequest;
use App\Http\Requests\Account\EditRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Services\AccountRoleAndPermissionService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    private $accountRoleAndPermissionService;

    public function __construct(AccountRoleAndPermissionService $accountRoleAndPermissionService)
    {
        $this->accountRoleAndPermissionService = $accountRoleAndPermissionService;
    }

    public function index(Request $request)
    {
        $perPage  = $request->get('perPage', null);
        $keyword  = $request->get('keyword', null);
        $accounts = $this->accountRoleAndPermissionService->accountPaginate($perPage, $keyword);
        $accounts->appends($request->query())
            ->links();

        return response()->json($accounts);
    }

    public function create()
    {
        $roles = $this->accountRoleAndPermissionService->roleAll();

        return response()->json($roles);
    }

    public function store(StoreRequest $request)
    {
        $message = [
            'email.required'    => '帳號為必填',
            'email.unique'      => '此帳號已有人使用',
            'email.max'         => '帳號限制50字',
            'email.regex'       => '帳號限英數字',
            'name.required'     => '姓名為必填',
            'name.max'          => '姓名限制50字',
            'name.regex'        => '帳號限中英數字',
            'password.required' => '密碼為必填',
            'password.min'      => '密碼限制6字',
            'password.max'      => '密碼限制12字',
            'password.regex'    => '密碼限英數字',
        ];
        $this->validate($request, [
            'email'    => 'required|unique:users,email|max:50|regex:/^[A-Za-z0-9]+$/u',
            'name'     => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u',
            'password' => 'required|min:6|max:12|regex:/^[A-Za-z0-9]+$/u',
        ], $message);

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
        $message = [
            'email.required' => '帳號為必填',
            'email.max'      => '帳號限制50字',
            'email.regex'    => '帳號限英數字',
            'name.required'  => '姓名為必填',
            'name.max'       => '姓名限制50字',
            'name.regex'     => '帳號限中英數字',
            'password.min'   => '密碼限制6字',
            'password.max'   => '密碼限制12字',
            'password.regex' => '密碼限英數字',
        ];
        $this->validate($request, [
            'email'    => 'required|max:50|regex:/^[A-Za-z0-9]+$/u',
            'name'     => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u',
            'password' => 'min:6|max:12|regex:/^[A-Za-z0-9]+$/u',
        ], $message);

        $this->accountRoleAndPermissionService->accountUpdate($id, $request);

        return response()->json(['message' => '編輯成功']);
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->accountDestroy($id);

        return response()->json(['message' => '刪除成功']);
    }

    public function updateStatus(UpdateRequest $request, $id)
    {
        $this->accountRoleAndPermissionService->accountStatusUpdate($id, $request);

        return response()->json(['message' => '更新成功']);
    }

}
