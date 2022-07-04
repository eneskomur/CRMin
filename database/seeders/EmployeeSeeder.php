<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\HTTP;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 1000; $i++) {
            $profile_raw = HTTP::get('https://randomuser.me/api/?nat=tr');
            $profile = json_decode($profile_raw->body())->results[0];
            $avatar_raw = HTTP::get($profile->picture->large);
            $avatar = base64_encode($avatar_raw->body());
            $avatar = "data:image/png;base64,$avatar";
            
            DB::table('employees')->insert([
                'name' => $profile->name->first . ' ' . $profile->name->last,
                'email' => $profile->email,
                'avatar' => $avatar,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
