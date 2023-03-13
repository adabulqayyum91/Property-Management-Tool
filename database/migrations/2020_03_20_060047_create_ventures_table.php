<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('venture_automated_id', 50)->nullable();
            $table->enum('venture_status',['Active', 'Inactive'])->nullable();
            $table->string('venture_type')->nullable();
            $table->string('venture_source_type')->nullable();
            $table->string('venture_name')->nullable();
            $table->dateTime('date_of_incorporation')->nullable();
            $table->dateTime('date_of_Purchase')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('initial_cap')->nullable();
            $table->string('staff_manager')->nullable();
            $table->string('managing_member')->nullable();
            $table->string('venture_street')->nullable();
            $table->string('venture_city')->nullable();
            $table->string('venture_state')->nullable();
            $table->string('venture_zip')->nullable();
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
        Schema::dropIfExists('ventures');
    }
}
