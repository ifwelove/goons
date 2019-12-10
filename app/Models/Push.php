<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Push extends Model
{

    protected $table      = 'pushs';
    public    $timestamps = true;

    use SoftDeletes;
    protected $fillable = [
        'status',
        'title',
        'sub_title',
        'type',
        'start_date',
        'end_date',
        'url',
        'receiveNoti'
    ];
    protected $dates    = ['deleted_at'];
    protected $appends  = [
        'first_class',
        'sec_class',
        'last_class'
    ];

    public function getFirstClassAttribute()
    {
        $data = json_decode($this->url, true);
        if (! isset($data['firstClass'])) {
            return '';
        }
        $text = '';
        switch ($data['firstClass']) {
            case 'A':
                $text = '最新消息';
                break;
            case 'B':
                $text = '聯絡我們';
                break;
            case 'C':
                $text = '首頁';
                break;
            case 'D':
                $text = '音頻';
                break;
        }

        return $text;
    }

    public function getSecClassAttribute()
    {
        $data = json_decode($this->url, true);
        if (! isset($data['firstClass']) || ! isset($data['secClass'])) {
            return '';
        }
        $text = '';
        switch ($data['secClass']) {
            case 'A':
                $text = '節目';
                break;
            case 'B':
                $text = '新約';
                break;
            case 'C':
                $text = '舊約';
                break;
            default:
                $news = News::find($data['secClass']);
                if (!is_null($news)) {
                    $text = $news->title;
                }

                break;
        }

        return $text;
    }

    public function getLastClassAttribute()
    {
        $data = json_decode($this->url, true);
        if (! isset($data['firstClass']) || ! isset($data['secClass']) || ! isset($data['lastClass'])) {
            return '';
        }
        $text = '';
        switch ($data['secClass']) {
            case 'A':
                $program = Program::with('category')
                    ->find($data['lastClass']);
                if (!is_null($program)) {
                    $text    = $program->category->title;
                }
                break;
            case 'B':
                $program = BibleNewProgram::with('category')
                    ->find($data['lastClass']);
                if (!is_null($program)) {
                    $text    = $program->category->title;
                }
                break;
            case 'C':
                $program = BibleProgram::with('category')
                    ->find($data['lastClass']);
                if (!is_null($program)) {
                    $text    = $program->category->title;
                }
                break;
        }

        return $text;
    }
}
