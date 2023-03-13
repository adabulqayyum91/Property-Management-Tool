<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableListVenturesAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `lists_venture` ADD `useMarker` TINYINT NOT NULL DEFAULT 0 AFTER `longitude`;ALTER TABLE `lists_venture` ADD `featuredImageId` INT NOT NULL DEFAULT 0 AFTER `useMarker`;';
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
