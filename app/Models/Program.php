<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = [
        'status'
    ];

    public function getStatusAttribute()
    {
        if (Carbon::now() > $this->end_date) {
            return '已下架';
        }
        if (Carbon::now() >= $this->start_date && Carbon::now() <= $this->end_date) {
            return '已上架';
        }
        if (Carbon::now() <= $this->start_date) {
            return '預約中';
        }
    }
}
