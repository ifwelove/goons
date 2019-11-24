<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;
    protected $fillable = [
        'title', 'status', 'sub_title', 'anchor', 'image'
    ];
    protected $dates = ['deleted_at'];

    public function programs()
    {
        return $this->hasMany(Program::class, 'categories');
    }
}
