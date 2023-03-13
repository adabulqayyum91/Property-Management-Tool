<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSurveys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `surveys` (
                      `id` int(10) NOT NULL AUTO_INCREMENT,
                      `subject` varchar(100) NOT NULL,
                      `body` varchar(1000) NOT NULL,
                      `user_id` int(10) DEFAULT NULL,
                      `venture_id` int(10) DEFAULT NULL,
                      `due_date` timestamp NOT NULL DEFAULT current_timestamp(),
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
        Schema::dropIfExists('table_surveys');
    }
}
