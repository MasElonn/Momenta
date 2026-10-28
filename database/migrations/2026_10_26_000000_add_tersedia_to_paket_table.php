<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom "tersedia" ke tabel paket.
     *   true  = paket ada (bisa dipesan)
     *   false = paket tidak ada (tetap tampil, tetapi tidak bisa dipesan)
     *
     * default(true) membuat semua paket yang sudah ada otomatis berstatus "ada",
     * jadi data lama tidak berubah perilakunya.
     */
    public function up(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->boolean('tersedia')->default(true)->after('is_populer');
        });
    }

    public function down(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->dropColumn('tersedia');
        });
    }
};