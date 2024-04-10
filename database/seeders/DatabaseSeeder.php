<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::factory()->create([
            'name' => 'Humphrey Yeboah',
            'email' => 'haky@haky.com',
        ]);

        Task::factory(5)->create([
            'user_id' => $user->id
        ]);

        Project::factory(5)
            ->hasTasks(1, [
                'user_id' => $user->id,
            ])
            ->create([
                'user_id' => $user->id
            ]);
    }
}
