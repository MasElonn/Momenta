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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('trans_id');
            $table->foreignId('customer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('paket_id')->constrained('paket', 'paket_id')->onDelete('cascade');
            $table->string('bukti_bucket')->nullable();
            $table->string('bukti_key')->nullable();
            $table->enum('status', ['unpaid', 'pending', 'paid', 'rejected', 'expired'])->default('unpaid');
            $table->timestamp('verified_at')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
