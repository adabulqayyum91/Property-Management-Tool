<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 150)->nullable();
            $table->bigInteger('document_type_id')->nullable();
            $table->string('file_name', 150)->nullable();
            $table->string('type', 150)->nullable();
            $table->integer('mediaable_id')->unsigned();
            $table->string('mediaable_type', 150)->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->enum('visibility',array('Visible','Hidden'))->default('Visible');
            $table->dateTime('date_of_document_to_apply')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
