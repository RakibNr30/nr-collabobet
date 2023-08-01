<?php

namespace Database\Seeders;

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
            'dob' => Carbon::now()->subYears(20),
            'mobile' => '01710115566',
            'user_type' => UserType::ADMIN,
            'affiliate_code' => 'admin',
            'password' => Hash::make('password'),
            'profile_status' => 0,
            'mobile_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}