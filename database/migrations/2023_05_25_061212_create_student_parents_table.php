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
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->string('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('hp_ayah')->nullable();

            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->string('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('hp_ibu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parents');
    }
};
