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
            // $table->uuid('id')->primary();
            $table->id('id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('log_user')->nullable();
            $table->timestamp('tanggal_login')->nullable();
            $table->timestamp('tanggal_logout')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
