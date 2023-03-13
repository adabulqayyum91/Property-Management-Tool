<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserFilledSurveys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `user_filled_surveys` (
                      `id` int(10) NOT NULL AUTO_INCREMENT,
                      `user_id` int(10) DEFAULT NULL,
                      `survey_id` int(10) DEFAULT NULL,
                      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                      `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_user_filled_surveys');
    }
}
