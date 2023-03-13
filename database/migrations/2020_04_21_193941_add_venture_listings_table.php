<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVentureListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists_venture', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venture_id')->unsigned()->nullable();
            $table->enum('type',['NEW', 'CURRENT'])->nullable();
            $table->string('list_automated_id', 50)->nullable();
            $table->string('description')->nullable();
            $table->enum('list_status',['Live', 'Pending', 'Inactive'])->default('Pending');
            $table->boolean('feature')->default('0')->nullable();
            $table->string('asking_price')->nullable();
            $table->string('percentage_of_ownership')->nullable();
            $table->string('status', 100)->nullable();
            $table->string('cap_rate')->nullable();
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
        Schema::dropIfExists('lists_venture');
    }
}
