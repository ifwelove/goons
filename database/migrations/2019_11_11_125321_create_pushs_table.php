<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePushsTable extends Migration {

	public function up()
	{
		Schema::create('pushs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title', 500)->nullable();
			$table->string('sub_title', 500);
			$table->datetime('start_date')->nullable();
			$table->datetime('end_date')->nullable();
			$table->tinyInteger('status')->default('0');
			$table->tinyInteger('type')->default('0');
			$table->string('url', 500);
		});
	}

	public function down()
	{
		Schema::drop('pushs');
	}
}
