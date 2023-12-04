<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@gmail.com',
               'role'=>0,
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Manager User 1',
               'email'=>'manager01@gmail.com',
               'role'=> 1,
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Manager User 2',
               'email'=>'manager02@gmail.com',
               'role'=>1,
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Manager User 3',
                'email'=>'manager03@gmail.com',
                'role'=>1,
                'password'=> bcrypt('12345678'),
             ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
