<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVentureRentals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $sql = 'CREATE TABLE `venture_rentals` ( `id` INT(10) NOT NULL AUTO_INCREMENT ,  `venture_id` INT(10) NOT NULL ,  `date_rent_collected` VARCHAR(20) NULL DEFAULT NULL ,  `rent_due` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `amount_collected` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `rent_past_due` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `fees_and_other_income` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `management_fee` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `repairs_and_other_expenses` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `net_income` DECIMAL(8,2) NOT NULL DEFAULT 0.00 ,  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB';
        DB::connection()->getPdo()->exec($sql);

        ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_venture_rentals');
    }
}
