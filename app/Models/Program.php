<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{

    protected $table = 'programs';
    public $timestamps = true;

    use SoftDeletes;

    protected $fillable = [
        'title', 'url', 'sub_title', 'anchor', 'start_date', 'end_date', 'categories'
    ];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories');
    }
}
