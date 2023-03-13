<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `users` ADD `street` VARCHAR(191) NULL DEFAULT NULL AFTER `phone`, ADD `city` VARCHAR(191) NULL DEFAULT NULL AFTER `street`, ADD `state` INT(10) NULL DEFAULT NULL AFTER `city`, ADD `zip` VARCHAR(50) NULL DEFAULT NULL AFTER `state`, ADD `date_of_birth` DATE NULL DEFAULT NULL AFTER `zip`, ADD `social_security_number` VARCHAR(100) NULL DEFAULT NULL AFTER `date_of_birth`';
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
