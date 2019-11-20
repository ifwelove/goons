<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BibleNewProgram extends Model
{

    protected $table = 'bible_new_programs';
    public $timestamps = true;

    use SoftDeletes;
    protected $fillable = ['categories', 'url', 'title', 'sub_title', 'sort', 'image', 'anchor', 'end_date', 'start_date'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(BibleNewCategory::class, 'categories');
    }
}
