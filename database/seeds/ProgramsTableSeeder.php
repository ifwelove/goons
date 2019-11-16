<?php

use Illuminate\Database\Seeder;
use \App\Models\Program;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Program::class, 100)->create();
    }
}
