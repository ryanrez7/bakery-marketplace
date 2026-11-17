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
    Schema::create('bakeries', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('slug')->unique();
        $table->string('jenis_usaha', 50);
        $table->string('alamat');
        $table->string('kecamatan', 50);
        $table->string('email');
        $table->string('whatsapp', 20);

        // PENDING = menunggu verifikasi admin, ACTIVE = boleh login, REJECTED = ditolak
        $table->string('status', 20)->default('PENDING')->index();
        $table->text('alasan_penolakan')->nullable();

        // lokasi berkas hasil upload (file disimpan di storage, bukan di database)
        $table->string('ktp_path')->nullable();
        $table->string('izin_usaha_path')->nullable();
        $table->string('foto_toko_path')->nullable();
        $table->string('dokumen_lain_path')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bakeries');
    }
};
