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
        Schema::create('salary_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('salary_type_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('pokok')->nullable();
            $table->string('fungsional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_positions');
    }
};
