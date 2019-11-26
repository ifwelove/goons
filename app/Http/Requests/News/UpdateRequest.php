<?php

namespace App\Http\Requests\News;

use App\Http\Requests\BasicRequest;
use App\Models\News;

class UpdateRequest extends BasicRequest
{
    public function __construct()
    {
    }

    public function authorize()
    {
        return News::find($this->route('news'));
    }

    public function rules()
    {
        return [
//            'roles' => 'required|exists:roles,id',
        ];
    }
}
