<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `communications` (
                  `id` int(10) NOT NULL AUTO_INCREMENT,
                  `venture_id` int(10) DEFAULT NULL,
                  `to_user` int(10) DEFAULT NULL,
                  `from_user` int(10) DEFAULT NULL,
                  `subject` varchar(100) DEFAULT NULL,
                  `body` varchar(1000) DEFAULT NULL,
                  `read_status` tinyint(3) DEFAULT 0,
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
        Schema::dropIfExists('communication');
    }
}
