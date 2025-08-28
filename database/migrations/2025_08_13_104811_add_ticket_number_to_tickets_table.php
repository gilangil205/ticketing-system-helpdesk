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
    Schema::table('tickets', function (Blueprint $table) {
        $table->string('ticket_number', 20)->nullable()->after('id'); // tanpa unique dulu
    });
}


    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropColumn('ticket_number');
    });
}
};
