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
            $table->id()->index(); // Primary key with index
            $table->string('name')->nullable()->index('user_name'); // Nullable full name
            $table->string('email')->nullable()->unique()->index('user_email'); // Nullable and unique email
            $table->string('contact_number')->nullable()->index('user_contact_number'); // Nullable contact number
            $table->string('password')->nullable(); // Nullable password
            $table->tinyInteger('is_frequent_shopper')->nullable()->default(0)->index('user_is_frequent_shopper'); // Boolean with default 0 (No)
            $table->rememberToken()->nullable(); // Nullable remember token
            //$table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete(); // Nullable foreign key for role_id with onDelete set to NULL
            $table->timestamps(); // Nullable timestamps are default in Laravel
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


