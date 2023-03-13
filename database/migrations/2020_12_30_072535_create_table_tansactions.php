<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTansactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `transactions` (
                  `id` int(10) NOT NULL AUTO_INCREMENT,
                  `label` varchar(100) NOT NULL,
                  `ownership_id` int(10) NOT NULL,
                  `venture_id` int(10) NOT NULL,
                  `user_id` int(10) NOT NULL,
                  `note` varchar(250) DEFAULT NULL,
                  `type` tinyint(3) NOT NULL DEFAULT 0,
                  `value` decimal(8,2) DEFAULT 0.00,
                  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
                  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4';
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_tansactions');
    }
}
