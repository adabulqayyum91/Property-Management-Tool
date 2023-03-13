<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNewVentureCommitsAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'ALTER TABLE `new_venture_commits` ADD `unitStart` VARCHAR(20) NOT NULL DEFAULT 00000 AFTER `amount`, ADD `unitEnd` VARCHAR(20) NOT NULL DEFAULT 00000 AFTER `unitStart`;';
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
