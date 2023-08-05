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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('type')->comment('1. Participant, 2. Recommendation, 3. Benefactor, 4. Genius');
            $table->unsignedBigInteger('amount')->default(0);
            $table->integer('total_rewards')->default(0);
            $table->integer('claimed_rewards')->default(0);
            $table->boolean('is_available')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
