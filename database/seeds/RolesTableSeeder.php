<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'account',
            'slug' => '帳號管理',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'category',
            'slug' => '節目分類管理',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'news',
            'slug' => '最新消息管理',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'program',
            'slug' => '節目內容管理',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'push',
            'slug' => '推播管理',
            'guard_name' => 'web'
        ]);
    }
}
