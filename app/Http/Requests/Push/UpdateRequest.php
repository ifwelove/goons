<?php

namespace App\Http\Requests\Push;

use App\Http\Requests\BasicRequest;
use App\Models\Push;

class UpdateRequest extends BasicRequest
{
    public function __construct()
    {
    }

    public function authorize()
    {
        return Push::find($this->route('push'));
    }

    public function rules()
    {
        return [
//            'roles' => 'required|exists:roles,id',
        ];
    }
}
