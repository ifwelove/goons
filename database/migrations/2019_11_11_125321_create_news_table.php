<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	public function up()
	{
		Schema::create('news', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->tinyInteger('type')->unsigned()->default('0');
			$table->tinyInteger('auto_push')->unsigned()->default('0');
			$table->datetime('start_date')->nullable();
			$table->datetime('end_date')->nullable();
			$table->string('title', 100);
            $table->longText('description');
		});
	}

	public function down()
	{
		Schema::drop('news');
	}
}
