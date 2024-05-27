<?php


// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'user1'
        ]);

        User::create([
            'username' => 'user2'
        ]);

        User::create([
            'username' => 'user3'
        ]);
    }
}
