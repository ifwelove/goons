<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ClientSender extends Model
{
    use SoftDeletes;

    protected $table      = 'client_sender';
    public    $timestamps = false;
    protected $dates      = ['deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
