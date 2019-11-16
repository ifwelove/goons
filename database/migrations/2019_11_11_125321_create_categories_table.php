<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
            $table->tinyInteger('type')->unsigned()->default('0');// 1: iOS, 2: Android
			$table->string('title', 50);
			$table->string('sub_title', 500);
			$table->string('image', 500);
			$table->string('anchor', 50);
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
