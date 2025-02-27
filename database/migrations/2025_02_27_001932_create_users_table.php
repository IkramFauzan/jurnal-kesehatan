<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('given_name');     // Nama depan
            $table->string('family_name');    // Nama belakang
            $table->string('afiliasi')->nullable(); // Afiliasi (opsional)
            $table->string('country');        // Negara
            $table->string('email')->unique(); // Email unik
            $table->string('password');       // Password
            $table->rememberToken();          // Token untuk "remember me"
            $table->timestamps();             // created_at & updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
