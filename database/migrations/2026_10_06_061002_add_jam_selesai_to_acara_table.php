<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Additive only — extends the existing `acara` table (created in
     * 2026_08_07_132147_create_acara_table.php) with an end-time column so
     * the availability checker can detect overlapping bookings. Nullable so
     * existing rows (which only ever stored a single `jam`) are not broken.
     */
    public function up(): void
    {
        Schema::table('acara', function (Blueprint $table) {
            $table->time('jam_selesai')->nullable()->after('jam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acara', function (Blueprint $table) {
            $table->dropColumn('jam_selesai');
        });
    }
};