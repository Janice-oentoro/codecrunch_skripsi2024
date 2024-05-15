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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->startingValue(13);
            $table->timestamps();
            $table->foreignId('consultation_id')->constrained('consultations');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('transaction_datetime');
            $table->integer('amount');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
