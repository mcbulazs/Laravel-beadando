<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;
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

        User::factory(10)->create([]);
        $users = collect();
        $userCount = rand(10, 20);
        for ($i = 0; $i < $userCount; $i++) {
            $users->push(User::factory()->create());
        }
        $characters = collect();
        $characterCount = rand(10, 20);
        for ($i = 0; $i < $characterCount; $i++) {
            $character = Character::factory()->make();
            $character->user()->associate($users->random());
            $character->save();
            $characters->push($character);
        }

        Character::factory(10)->create([]);
        Place::factory(10)->create([]);
        Contest::factory(10)->create([]);
    }
}
