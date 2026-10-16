<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->string('durasi')->nullable()->after('harga');
            $table->string('jumlah_foto')->nullable()->after('durasi');
            $table->string('jumlah_fotografer')->nullable()->after('jumlah_foto');
            $table->string('durasi_galeri')->nullable()->after('jumlah_fotografer');
            $table->boolean('is_populer')->default(false)->after('durasi_galeri');
        });
    }

    public function down(): void
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->dropColumn([
                'durasi',
                'jumlah_foto',
                'jumlah_fotografer',
                'durasi_galeri',
                'is_populer',
            ]);
        });
    }
};