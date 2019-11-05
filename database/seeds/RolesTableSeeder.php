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
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'headquarter',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'client',
            'guard_name' => 'web'
        ]);
    }
}
