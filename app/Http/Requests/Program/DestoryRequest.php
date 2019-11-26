<?php

namespace App\Http\Requests\Program;

use App\Http\Requests\BasicRequest;
use App\Models\Program;

class DestoryRequest extends BasicRequest
{

    public function __construct()
    {
    }

    public function authorize()
    {
        return Program::find($this->route('program'));
    }

    public function rules()
    {
        return [];
    }
}
