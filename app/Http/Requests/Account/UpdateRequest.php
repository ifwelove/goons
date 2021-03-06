<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BasicRequest;
use App\Repositories\AccountsRepository;

class UpdateRequest extends BasicRequest
{
    private $accountRepository;

    public function __construct(AccountsRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function authorize()
    {
        return $this->accountRepository->find($this->route('account'));
    }

    public function rules()
    {
        return [
//            'roles' => 'required|exists:roles,id',
        ];
    }
}
