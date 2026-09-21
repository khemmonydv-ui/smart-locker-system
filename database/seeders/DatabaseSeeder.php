<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
             Profile::create([
                'user_id' => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'phone'   => '+1 555-1001',
                'address' => '123 Main St',
            ]);
    }
}
