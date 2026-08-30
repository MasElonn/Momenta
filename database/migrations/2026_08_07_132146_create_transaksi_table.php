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
            $table->foreignId('customer_id')->constrained('users','user_id')->onDelete('cascade');
            $table->foreignId('paket_id')->constrained('paket','paket_id')->onDelete('cascade');
            $table->string('midtrans_order_id')->unique();
            $table->string('snap_token')->nullable();
            $table->string('payment_type')->nullable();
            $table->enum('status', ['pending','paid', 'expired','failed'])->default('pending');
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
