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
        Schema::create('portofolio', function (Blueprint $table) {
            $table->id('portofolio_id');
            $table->foreignId('fotografer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->string('r2_bucket');
            $table->string('r2_key');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio');
    }
};
