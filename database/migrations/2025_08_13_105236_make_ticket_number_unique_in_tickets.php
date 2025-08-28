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
        $table->unique('ticket_number');
    });
}

public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropUnique(['ticket_number']);
    });
}

};
