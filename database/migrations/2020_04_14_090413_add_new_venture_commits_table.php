<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewVentureCommitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_venture_commits',function (Blueprint $table){
        $table->bigIncrements('id');
        $table->integer('new_venture_listing_id')->unsigned()->nullable();
        $table->integer('user_id')->unsigned()->nullable();
         $table->string('amount')->nullable();
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
        Schema::dropIfExists('new_venture_commits');
    }
}
