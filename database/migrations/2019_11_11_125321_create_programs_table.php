<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramsTable extends Migration {

	public function up()
	{
		Schema::create('programs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('categories')->unsigned();
			$table->integer('sort');
			$table->string('anchor', 50);
			$table->string('title', 50);
			$table->string('sub_title', 500);
			$table->string('url', 500);
			$table->datetime('start_date')->nullable();
			$table->datetime('end_date')->nullable();
			$table->integer('duration')->default('0');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('programs');
	}
}
