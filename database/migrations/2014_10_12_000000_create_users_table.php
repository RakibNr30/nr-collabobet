<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->unique();
            $table->timestamp('dob')->nullable();
            $table->tinyInteger('user_type');
            $table->string('affiliate_code')->nullable();
            $table->string('refer_affiliate_code')->nullable();
            $table->unsignedBigInteger('refer_reward')->nullable();
            $table->unsignedDouble('refer_reward_amount')->nullable();
            $table->string('ssn')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_status')->default(0)->comment('0. NONE, 1. ACCOUNT CREATED, 2. PERSONAL DETAILS CREATED, 3. VERIFICATION COMPLETED');
            $table->boolean('is_verification_requested')->default(false);
            $table->timestamp('mobile_verified_at')->nullable();
            $table->boolean('is_agreement_accepted')->default(false)->comment('0. NO, 1. YES');
            $table->boolean('is_tc_accepted')->default(false)->comment('0. NO, 1. YES');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
