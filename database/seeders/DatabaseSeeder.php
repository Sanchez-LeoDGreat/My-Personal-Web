<?php

namespace Database\Seeders;

use App\Models\Timeline;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Leonard Paulo',
            'last_name' => 'Sanchez',
            'email' => 'test@example.com',
        ]);

        $this->call(
            TimelineSeeder::class,
        );
    }
}
