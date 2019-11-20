<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBibleNewCategoriesTable extends Migration {

	public function up()
	{
//		Schema::create('bible_new_categories', function(Blueprint $table) {
//			$table->increments('id');
//            $table->tinyInteger('status')->unsigned()->default(1);
//            $table->integer('sort');
//            $table->string('title', 50);
//			$table->string('sub_title', 500);
//			$table->string('image', 500);
//			$table->string('anchor', 50);
//            $table->timestamps();
//            $table->softDeletes();
//		});

        \DB::connection('mysql')->statement("CREATE TABLE `bible_new_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anchor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
        \DB::connection('mysql')->statement("INSERT INTO `bible_new_categories` (`id`, `status`, `sort`, `title`, `sub_title`, `image`, `anchor`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,1,'馬太福音','馬太福音','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(2,1,1,'馬可福音','馬可福音','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(3,1,1,'路加福音','路加福音','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(4,1,1,'約翰福音','約翰福音','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(5,1,1,'使徒行傳','使徒行傳','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(6,1,1,'羅馬書','羅馬書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(7,1,1,'哥林多前書','哥林多前書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(8,1,1,'哥林多後書','哥林多後書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(9,1,1,'加拉太書','加拉太書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(10,1,1,'以弗所書','以弗所書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(11,1,1,'腓利比書','腓利比書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(12,1,1,'歌羅西書','歌羅西書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(13,1,1,'帖撒羅尼迦前書','帖撒羅尼迦前書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(14,1,1,'帖撒羅尼迦後書','帖撒羅尼迦後書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(15,1,1,'提摩太前書','提摩太前書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(16,1,1,'提摩太後書','提摩太後書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(17,1,1,'提多書','提多書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(18,1,1,'腓利門書','腓利門書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(19,1,1,'希伯來書','希伯來書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(20,1,1,'雅各書','雅各書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(21,1,1,'彼得前書','彼得前書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(22,1,1,'彼得後書','彼得後書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(23,1,1,'約翰壹書','約翰壹書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(24,1,1,'約翰貳書','約翰貳書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(25,1,1,'約翰參書','約翰參書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(26,1,1,'猶大書','猶大書','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL),
	(27,1,1,'啟示錄','啟示錄','','閻大衛','2019-11-20 12:00:39','2019-11-20 12:00:39',NULL);");
	}

	public function down()
	{
		Schema::drop('bible_new_categories');
	}
}
