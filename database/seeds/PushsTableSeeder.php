<?php

use Illuminate\Database\Seeder;

class PushsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Push::class, 20)->create();
    }
}
