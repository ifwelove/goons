<?php

namespace App\Models;

use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    const ACCOUNT       = 'account';
    const CATEGORY = 'category';
    const NEWS      = 'news';
    const PROGRAM      = 'program';
    const PUSH      = 'push';

    static function implodeAll($implode = '|')
    {
        $rows = [
            self::ACCOUNT,
            self::CATEGORY,
            self::NEWS,
            self::PROGRAM,
            self::PUSH,
        ];

        return implode($implode, $rows);
    }
}
