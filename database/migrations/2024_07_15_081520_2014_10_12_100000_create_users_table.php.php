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
            $table->id();
            $table->string('user_code')->nullable();
            $table->string('user_name')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->unique()->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('provider_token')->unique()->nullable();
            $table->string('birthdate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password')->nullable();
            $table->timestamp('last_active_at')->nullable();
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
