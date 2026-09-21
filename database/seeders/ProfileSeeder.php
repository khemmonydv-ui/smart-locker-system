<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name'     => 'Alex Johnson',
                'email'    => 'alex.johnson@email.com',
                'password' => Hash::make('password'), // login with this password
            ]);
        }

        Profile::create([
            'user_id' => $user->id,
            'name'    => 'Alex Johnson',
            'email'   => 'alex.johnson@email.com',
            'phone'   => '+1 555-1001',
            'address' => '123 Main St',
        ]);
    }
}