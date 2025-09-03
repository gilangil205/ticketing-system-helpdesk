<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('projects', function (Blueprint $table) {
        $table->unsignedBigInteger('client_id')->nullable()->after('id');

        // Jika ingin relasi foreign key ke tabel users/clients
        $table->foreign('client_id')->references('id')->on('users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('projects', function (Blueprint $table) {
        $table->dropForeign(['client_id']);
        $table->dropColumn('client_id');
    });
}

};
