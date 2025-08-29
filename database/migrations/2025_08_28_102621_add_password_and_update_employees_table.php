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
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan kolom password jika belum ada
            if (!Schema::hasColumn('employees', 'password')) {
                $table->string('password')->nullable()->after('email');
            }
        });

        // Update password default untuk yang masih null
        DB::table('employees')
            ->whereNull('password')
            ->update([
                'password'   => Hash::make('password123'), // default password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};
