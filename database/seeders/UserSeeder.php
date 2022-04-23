<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'id'=> 1,
            'name' => 'admin',
            'email' => 'admin@admin',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('admin'),
            'remember_token' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        User::insert($admin);
    }
}
