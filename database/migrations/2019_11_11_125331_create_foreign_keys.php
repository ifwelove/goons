<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('programs', function(Blueprint $table) {
			$table->foreign('categories')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('programs', function(Blueprint $table) {
			$table->dropForeign('programs_categories_foreign');
		});
	}
}