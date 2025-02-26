<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'Tester',
            'email' => 't.tester@test.it',
            'password' => Hash::make('querty'),
            'remember_token' => 'test_token',
        ]);

        User::factory(999)->create()->each(function ($user) {
            $addresses = Address::inRandomOrder()->limit(rand(1, 3))->pluck('id');

            $user->addresses()->attach($addresses);
        });
    }
}
