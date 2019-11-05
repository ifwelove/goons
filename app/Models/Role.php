<?php

namespace App\Models;

use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    const ADMIN       = 'admin';
    const HEADQUARTER = 'headquarter';
    const CLIENT      = 'client';

    static function implodeAll($implode = '|')
    {
        $rows = [
            self::ADMIN,
            self::HEADQUARTER,
            self::CLIENT,
        ];

        return implode($implode, $rows);
    }
}
