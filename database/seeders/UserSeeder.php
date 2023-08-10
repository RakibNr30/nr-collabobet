<?php

namespace Database\Seeders;

use App\Constants\ProfileStatus;
use App\Constants\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'dob' => Carbon::now()->subYears(25),
            'mobile' => '0123456789',
            'user_type' => UserType::ADMIN,
            'affiliate_code' => 'admin',
            'password' => Hash::make('password'),
            'profile_status' => ProfileStatus::NONE,
            'mobile_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'first_name' => 'User',
            'last_name' => 'One',
            'dob' => Carbon::now()->subYears(25),
            'mobile' => '1123456789',
            'user_type' => UserType::USER,
            'affiliate_code' => 'user1',
            'password' => Hash::make('password'),
            'profile_status' => ProfileStatus::ACCOUNT_CREATED,
            'mobile_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
