<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSettingAddLabelStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `settings` DROP `home_price_sec`;
                ALTER TABLE `settings` ADD `label` VARCHAR(100) NOT NULL AFTER `id`, ADD `status` TINYINT(3) NOT NULL DEFAULT 1 AFTER `label`';
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
