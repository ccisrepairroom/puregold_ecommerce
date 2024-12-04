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
            $table->string('name')->nullable()->index('user_name')->onDelete('cascade'); // Nullable full name
            $table->string('email')->nullable()->unique()->index('user_email')->onDelete('cascade'); // Nullable and unique email
            $table->string('contact_number')->nullable()->index('user_contact_number')->onDelete('cascade'); // Nullable contact number
            $table->string('profile_image')->nullable()->index('user_profile_image')->onDelete('cascade');
            $table->string('password')->nullable()->onDelete('cascade'); // Nullable password
            $table->tinyInteger('is_frequent_shopper')->nullable()->default(0)->index('user_is_frequent_shopper')->onDelete('cascade'); // Boolean with default 0 (No)
            $table->rememberToken()->nullable()->onDelete('cascade'); // Nullable remember token
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


