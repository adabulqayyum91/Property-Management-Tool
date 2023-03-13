<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableListVenturesAddOwnershipid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `lists_venture` ADD `ownership_id` INT(10) NOT NULL DEFAULT 0 AFTER `cap_rate`;';
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
