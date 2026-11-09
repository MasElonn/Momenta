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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->enum('role', ['customer', 'fotografer', 'admin'])->default('customer');
            $table->enum('status_akun', ['active', 'pending', 'rejected'])->default('active');
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('foto_karya')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_hp', 20)->nullable();
            $table->text('bio')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('instagram', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
