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
        return true;
    }

    public function rules()
    {
        return [];
    }
}
