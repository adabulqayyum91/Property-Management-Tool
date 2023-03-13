<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCommunicationSurveyQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE TABLE `survey_questions` (
                  `id` int(10) NOT NULL AUTO_INCREMENT,
                  `survey_id` int(10) NOT NULL,
                  `question` varchar(500) NOT NULL,
                  `created_at` timestamp NULL DEFAULT current_timestamp(),
                  `updated_at` timestamp NULL DEFAULT current_timestamp(),
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
        Schema::dropIfExists('table_communication_survey_questions');
    }
}
