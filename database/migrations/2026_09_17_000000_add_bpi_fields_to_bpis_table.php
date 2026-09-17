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
        Schema::table('bpis', function (Blueprint $table) {
            $table->integer('presence_count')->nullable()->after('date');
            $table->text('absence_info')->nullable()->after('presence_count');
            $table->text('material')->nullable()->after('absence_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bpis', function (Blueprint $table) {
            $table->dropColumn(['presence_count', 'absence_info', 'material']);
        });
    }
};
