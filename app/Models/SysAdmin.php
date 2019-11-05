<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class SysAdmin extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    protected $table = 'sys_admin';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'client_id',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function senders()
    {
        return $this->belongsTo(ClientSender::class, 'client_id', 'client_id');
    }

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();

        if (! $isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

    public function isAdmin()
    {
        return $this->role_type == 1;
    }

    public function getRoleName()
    {
        return $this->roles()->first()->name;
    }
}
