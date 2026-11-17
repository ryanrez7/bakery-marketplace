<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek dan tambahkan bakery_id jika belum ada
            if (!Schema::hasColumn('users', 'bakery_id')) {
                $table->foreignId('bakery_id')->nullable()->after('id')
                    ->constrained('bakeries')->nullOnDelete();
            }

            // Cek dan tambahkan role jika belum ada
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role', 20)->default('customer')->after('password')->index();
            }

            // Cek dan tambahkan whatsapp jika belum ada
            if (!Schema::hasColumn('users', 'whatsapp')) {
                $table->string('whatsapp', 20)->nullable()->after('role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'bakery_id')) {
                $table->dropConstrainedForeignId('bakery_id');
            }
            
            $columnsToDrop = [];
            if (Schema::hasColumn('users', 'role')) {
                $columnsToDrop[] = 'role';
            }
            if (Schema::hasColumn('users', 'whatsapp')) {
                $columnsToDrop[] = 'whatsapp';
            }
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};