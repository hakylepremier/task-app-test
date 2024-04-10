<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyuser = null;
        if (User::where('email', 'dummy@example.com')->count() == 0) {
            $dummyuser = \App\Models\User::factory()->create([
                'name' => 'Dummy User',
                'email' => 'dummy@example.com',
            ]);
        }

    }
}
