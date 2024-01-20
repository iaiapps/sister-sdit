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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('salary_basic_id')->nullable();
            // $table->integer('salary_functional_id')->nullable();
            $table->string('full_name');
            $table->string('gender')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('last_education')->nullable();
            $table->string('month_enter')->nullable();
            $table->string('year_enter')->nullable();
            $table->string('no_hp')->nullable();
            // $table->string('email');

            //second
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();

            //third
            $table->string('marriage_status')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_job')->nullable();
            $table->string('children_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
