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
        Schema::create('paket', function (Blueprint $table) {
            $table->id('paket_id');
            $table->foreignId('fotografer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->decimal('harga', 12, 2);
            $table->string('durasi')->nullable();
            $table->string('jumlah_foto')->nullable();
            $table->string('jumlah_fotografer')->nullable();
            $table->string('durasi_galeri')->nullable();
            $table->boolean('is_populer')->default(false);
            $table->boolean('tersedia')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
