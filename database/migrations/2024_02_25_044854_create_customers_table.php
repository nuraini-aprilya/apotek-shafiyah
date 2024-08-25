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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name')->default('-');
            $table->string('last_name')->default('-');
            $table->date('birth_date')->default('2024-02-02');
            $table->string('phone_number')->default('-');
            $table->string('province')->default('-');
            $table->string('district')->default('-');
            $table->string('subdistrict')->default('-');
            $table->string('postal_code')->default('-');
            $table->string('address')->default('-');
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
