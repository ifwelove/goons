<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BasicRequest;

class StoreRequest extends BasicRequest
{
    public function __construct()
    {
    }

    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [];
    }
}
