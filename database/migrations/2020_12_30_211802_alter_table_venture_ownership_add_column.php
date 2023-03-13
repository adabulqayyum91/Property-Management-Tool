<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVentureOwnershipAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `venture_ownerships` ADD `isDeleted` TINYINT(3) NOT NULL DEFAULT 0 AFTER `ownership_end_date`, ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `isDeleted`;';
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
