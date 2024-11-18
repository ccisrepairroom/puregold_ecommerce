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
            $table->id()->index('index_id'); // Index for the id column
            $table->string('name')->nullable()->index('index_name'); // Index for name column
            $table->string('email')->nullable()->unique()->index('index_email'); // Index for email column (unique and indexed)
            $table->timestamp('email_verified_at')->nullable()->index('index_email_verified_at'); // Index for email_verified_at
            $table->string('password')->nullable()->index('index_password'); // Index for password column
            $table->rememberToken()->nullable()->index('index_remember_token'); // Index for remember_token
            $table->string('phone_number', 11)->nullable()->index('index_phone_number'); // Index for phone_number
            //$table->foreignId('role_id')->nullable()->constrained()->index('index_role_id'); // Index for role_id column
            $table->text('address')->nullable()->index('index_address'); // Index for address column
            $table->timestamps(); // created_at and updated_at will be indexed by default
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
