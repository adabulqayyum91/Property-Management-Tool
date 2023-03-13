<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVentureOwnership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `venture_ownerships` ( `id` INT(10) NOT NULL AUTO_INCREMENT ,  `venture_id` INT(10) NOT NULL ,  `user_id` INT(10) NOT NULL ,  `ownership_sequence_start` VARCHAR(10) NOT NULL ,  `ownership_sequence_end` VARCHAR(10) NOT NULL ,  `amount_paid` INT(10) NOT NULL DEFAULT 0 ,  `amount_sold` INT(10) NOT NULL DEFAULT 0 ,  `ownership_begin_date` VARCHAR(20) NULL DEFAULT NULL ,  `ownership_end_date` VARCHAR(10) NULL DEFAULT NULL ,  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;';
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venture_ownerships');
    }
}
