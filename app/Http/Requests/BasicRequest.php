<?php

namespace App\Http\Requests;

class BasicRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
