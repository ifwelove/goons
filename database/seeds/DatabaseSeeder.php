<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(AccountsTableSeeder::class);
         $this->call(NewsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(ProgramsTableSeeder::class);
    }
}
