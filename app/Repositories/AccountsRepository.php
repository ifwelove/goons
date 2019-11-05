<?php

namespace App\Repositories;

//use App\Models\SysAdmin as Account;
use App\User as Account;

class AccountsRepository extends Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
    }
}
