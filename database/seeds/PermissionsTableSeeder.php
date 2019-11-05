<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'edit_post',
            'guard_name' => 'web',
            'slug' => '編輯文章'
        ]);
        Permission::create([
            'name' => 'delete_post',
            'guard_name' => 'web',
            'slug' => '刪除文章'
        ]);
        Permission::create([
            'name' => 'get_post',
            'guard_name' => 'web',
            'slug' => '新增文章'
        ]);
        Permission::create([
            'name' => 'create_post',
            'guard_name' => 'web',
            'slug' => '查看文章'
        ]);
    }
}
