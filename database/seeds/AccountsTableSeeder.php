<?php

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
        $role = Role::all();
        factory(User::class, 10)->create()->each(function ($u) use ($role) {
            $u->assignRole($role);
        });

        $user = User::find(1);
        $user->email = 'admin@test.com';
        $user->save();
    }
}
