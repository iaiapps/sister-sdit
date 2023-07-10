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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('nis')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nik')->nullable();
            $table->string('kk')->nullable();
            $table->string('akte')->nullable();
            $table->string('gender')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('sekolah_asal')->nullable();
            $table->string('jenis_tinggal')->nullable();
            $table->string('alat_transportasi')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('jarak_ke_sekolah')->nullable();

            // $table->string('grade_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
