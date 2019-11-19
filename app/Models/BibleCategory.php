<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BibleCategory extends Model
{

    protected $table = 'bible_categories';
    public $timestamps = true;

    use SoftDeletes;
    protected $fillable = ['title', 'sub_title', 'sort', 'image', 'anchor', 'end_date', 'start_date'];
    protected $dates = ['deleted_at'];

    public function programs()
    {
        return $this->hasMany(BibleProgram::class, 'categories');
    }
}
