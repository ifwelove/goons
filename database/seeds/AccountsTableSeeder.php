<?php

use App\Models\Permission;
//use App\Models\SysAdmin as User;
use App\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('id', '=', 1)->firstOrFail();
        factory(User::class, 10)->create()->each(function ($u) use ($role) {
            $u->assignRole($role);
        });
        $permission = Permission::find(1)->first();
        $role->givePermissionTo($permission);
    }
}
