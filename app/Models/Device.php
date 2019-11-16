<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    protected $table = 'device';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

}
