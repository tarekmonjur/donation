<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'afc',
            'lastname' => 'health',
            'email' => 'iddl@gmail.com',
            'password' => 123456,
            'remember_token' => '',
            'mobile_no' => '0123456789',
            'user_type' => 1,
            'designation' => 'Manager',
            'address' => '',
            'verify' => 1,
            'token' => '',
        ]);
    }
}
