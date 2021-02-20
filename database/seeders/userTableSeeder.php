<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([

            'name' => 'Eslam',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('35612199'),
        ]);
        $user->attachRole('super_admin');
    }
}
