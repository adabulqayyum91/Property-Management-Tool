<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->string('status',50)->nullable()->after('venture_listing_id');
            $table->string('document_hash',255)->nullable()->after('status');
            $table->string('buyer_document_signing_url', 300)->nullable()->after('document_hash');
            $table->string('seller_document_signing_url', 300)->nullable()->after('buyer_document_signing_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('document_hash');
            $table->dropColumn('buyer_document_signing_url');
            $table->dropColumn('seller_document_signing_url');
            $table->enum('status', ['Pending', 'Approved'])->default('Pending')->after('venture_listing_id');
        });
    }
}

