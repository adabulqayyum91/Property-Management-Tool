<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentureDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venture_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venture_id')->unsigned()->nullable();
            $table->foreign('venture_id')->references('id')->on('ventures')->onDelete('cascade');
            $table->string('property_management_company')->nullable();
            $table->string('property_management_contact')->nullable();
            $table->string('property_management_street')->nullable();
            $table->string('property_management_phone')->nullable();
            $table->string('property_management_city')->nullable();
            $table->string('property_management_state')->nullable();
            $table->string('property_management_zip')->nullable();
            $table->string('property_street')->nullable();
            $table->string('property_city')->nullable();
            $table->string('property_state')->nullable();
            $table->string('property_zip')->nullable();
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
        Schema::dropIfExists('venture_details');
    }
}
