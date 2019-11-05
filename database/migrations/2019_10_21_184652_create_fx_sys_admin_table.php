<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFxSysAdminTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::connection('mysql')->statement("CREATE TABLE `sys_admin` (
            `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
            `client_id` int(5) unsigned NOT NULL DEFAULT '0' COMMENT 'client.id',
            `username` varchar(50) NOT NULL COMMENT '帳號',
            `password` varchar(32) NOT NULL COMMENT '密碼',
            `role_type` enum('1','3','4') NOT NULL DEFAULT '3' COMMENT '權限：1:系統管理者,3:客戶,4:wabow報表',
            `sys_role_type` enum('fd','sd','all') NOT NULL DEFAULT 'all' COMMENT '帳號權限：fd:使用FLYDOVE功能,sd:使用SMARTDOVE功能,all:全部功能',
            `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否啟停用：0:停用,1:啟用',
            `create_datetime` datetime DEFAULT NULL COMMENT '新增時間',
            `update_datetime` datetime DEFAULT NULL COMMENT '更新時間',
            `deleted_at` timestamp NULL DEFAULT NULL COMMENT '軟刪除時間',
            `memo` varchar(50) DEFAULT NULL COMMENT '備註',
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->drop('sys_admin');
    }
}
