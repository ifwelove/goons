<?php

namespace App\Models;

use Carbon\Carbon;
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
    protected $appends = [
        'status', 'push_status'
    ];

    public function getStatusAttribute()
    {
        if (Carbon::now() >= $this->start_date && Carbon::now() <= $this->end_date) {
            return '已上架';
        }
        if (Carbon::now() <= $this->start_date) {
            return '預約中';
        }
        if (Carbon::now() > $this->end_date) {
            return '已下架';
        }
    }

    public function getPushStatusAttribute()
    {
        if ($this->type) {
            return '已推播';
        }
        if($this->auto_push) {
            return '是';
        }
        if(!$this->auto_push) {
            return '否';
        }
    }
}
