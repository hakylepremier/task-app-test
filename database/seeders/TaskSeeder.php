<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyUser = null;
        if (\App\Models\User::where('email', 'dummy@example.com')->count() == 0) {
            $dummyUser = \App\Models\User::factory()->create([
                'name' => 'Dummy User',
                'email' => 'dummy@example.com',
            ]);
        }
        $dummyUser = \App\Models\User::where('email', 'dummy@example.com')->first();

        Task::factory(5)->create([
            'user_id' => $dummyUser->id,
        ]);
    }
}
