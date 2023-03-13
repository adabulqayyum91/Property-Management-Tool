<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusColumnInNewVentureCommits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_venture_commits', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('new_venture_commits', function (Blueprint $table) {
            $table->string('status',50)->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_venture_commits', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('new_venture_commits', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approval'])->default('pending')->after('amount');
        });
    }
}
