<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BasicRequest;
use App\Models\Category;

class DestoryRequest extends BasicRequest
{

    public function __construct()
    {
    }

    public function authorize()
    {
        return Category::find($this->route('category'));
    }

    public function rules()
    {
        return [];
    }
}
