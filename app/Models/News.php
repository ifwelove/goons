<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    protected $table = 'news';
    public $timestamps = true;

    use SoftDeletes;
    protected $fillable = [
        'auto_push', 'title', 'description', 'type', 'start_date', 'end_date'
    ];
    protected $dates = ['deleted_at'];

}
