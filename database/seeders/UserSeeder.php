<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1000)->create()->each(function ($user) {
            $addresses = Address::inRandomOrder()->limit(rand(1, 3))->pluck('id');

            $user->addresses()->attach($addresses);
        });
    }
}
