<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBibleCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('bible_categories', function(Blueprint $table) {
			$table->increments('id');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->integer('sort');
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
		Schema::drop('bible_categories');
	}
}
