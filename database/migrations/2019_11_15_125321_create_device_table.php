<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeviceTable extends Migration {

	public function up()
	{
		Schema::create('device', function(Blueprint $table) {
			$table->increments('id');
            $table->tinyInteger('type')->unsigned()->default('0');
            $table->string('token', 100)->unique();
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('device');
	}
}
