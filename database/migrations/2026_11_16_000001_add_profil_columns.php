<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bakeries', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('whatsapp');

            // titik koordinat Google Maps (7 angka di belakang koma = akurasi ~1 cm)
            $table->decimal('latitude', 10, 7)->nullable()->after('kecamatan');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

            // rekening penampung untuk pencairan dana (payout)
            $table->string('nama_bank', 50)->nullable();
            $table->text('nomor_rekening')->nullable(); // disimpan terenkripsi, jadi tipe text
            $table->string('atas_nama_rekening', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('bakeries', function (Blueprint $table) {
            $table->dropColumn([
                'deskripsi', 'latitude', 'longitude',
                'nama_bank', 'nomor_rekening', 'atas_nama_rekening',
            ]);
        });
    }
};
