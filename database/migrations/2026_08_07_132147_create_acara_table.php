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
        Schema::create('acara', function (Blueprint $table) {
            $table->id('acara_id');
            $table->foreignId('trans_id')->constrained('transaksi','trans_id')->onDelete('cascade');
            $table->string('judul');
            $table->text('lokasi');
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('status', ['upcoming', 'ongoing','completed'])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acara');
    }
};
