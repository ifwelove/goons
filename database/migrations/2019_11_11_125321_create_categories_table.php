<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->integer('sort')->default(0);
            $table->string('title', 50);
			$table->string('sub_title', 500);
			$table->string('image', 500);
			$table->string('anchor', 50);
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
