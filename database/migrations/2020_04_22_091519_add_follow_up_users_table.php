<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFollowUpUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
            $table->string('email')->unique();
            $table->string('phone', 14)->nullable();//+92 42 6855201
            $table->enum('contact_source', ['Email', 'Phone','Either'])->default('Email');
            $table->enum('status',['Approval', 'Pending'])->default('Pending');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('follow_up_users');

    }
}
