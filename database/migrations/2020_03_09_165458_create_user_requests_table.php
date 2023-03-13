<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email');
            $table->string('phone', 14)->nullable();
            $table->boolean('status')->default(true);
            $table->string('interest', 255)->nullable();
            $table->boolean('manage_income_property')->default(false);
            $table->enum('about_us_source', ['billboard', 'Radio','Web Search','Refered By a Friend','Other'])->default('billboard');
            $table->enum('contact_timing', ['Before 8 AM', '8 AM to Noon','Noon to 5 PM','After 5 PM'])->default('Before 8 AM');
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
        Schema::dropIfExists('user_requests');
    }
}
