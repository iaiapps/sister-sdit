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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nomor_slip');
            $table->date('bulan');
            $table->string('hadir');
            $table->string('tepat');
            $table->string('telat');
            $table->string('gaji_pokok');
            $table->string('gaji_fungsional')->nullable();
            $table->string('tot_fee_kehadiran');
            $table->string('ekskul')->nullable();
            $table->string('istri_anak')->nullable();
            $table->string('sukses_un_khotib')->nullable();
            $table->string('fee')->nullable();
            $table->string('hari_raya')->nullable();
            $table->string('dpp')->nullable();
            $table->string('koperasi')->nullable();
            $table->string('peminjaman')->nullable();
            $table->string('dansos')->nullable();
            $table->string('bpjs')->nullable();
            $table->string('komponen_a');
            $table->string('komponen_b');
            $table->string('komponen_c');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
