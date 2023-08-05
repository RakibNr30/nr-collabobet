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
            $table->id();
            $table->integer('type')->comment('1. IN, 2. OUT');
            $table->unsignedBigInteger('balance_id');
            $table->unsignedBigInteger('amount')->default(0);
            $table->string('account_owner')->nullable();
            $table->string('blz')->nullable();
            $table->string('iban')->nullable();
            $table->text('annotation')->nullable();
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(0)->comment('0. PENDING, 1. ACCEPTED, 2. DECLINED');
            $table->timestamp('actioned_at')->nullable();
            $table->timestamps();
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
