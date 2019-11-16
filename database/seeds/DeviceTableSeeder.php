<?php

use Illuminate\Database\Seeder;
use \App\Models\Device;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Device::class, 5)->create();
    }
}
