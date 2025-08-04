<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Pastikan kolom yang akan diupdate sudah ada
        if (Schema::hasTable('employees')) {
            // Update hanya record yang belum memiliki username/password
            DB::table('employees')
                ->whereNull('username')
                ->orWhereNull('password')
                ->update([
                    'username' => DB::raw('email'),
                    'password' => Hash::make('password123'), // Password default
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Tidak perlu melakukan apa-apa untuk data update
        // Atau bisa di-set ke null jika ingin reversible
        /*
        Schema::table('employees', function (Blueprint $table) {
            DB::table('employees')->update([
                'username' => null,
                'password' => null
            ]);
        });
        */
    }
};