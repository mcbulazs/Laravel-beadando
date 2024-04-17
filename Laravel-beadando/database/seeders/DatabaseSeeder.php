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
        $users = collect();
        $userCount = rand(10, 20);
        for ($i = 0; $i < $userCount; $i++) {
            $users->push(User::factory()->create());
        }
        $users->push(User::factory()->create([
            'admin' => true,
        ]));

        $characters = collect();
        $characterCount = rand(10, 20);
        for ($i = 0; $i < $characterCount; $i++) {
            $character = Character::factory()->make();
            $character->user()->associate($users->filter(fn ($user) => !$user->admin)->random());
            $character->save();
            $characters->push($character);
        }
        $enemyCharacters = collect();
        $enemyCharacterCount = rand(10, 20);
        for ($i = 0; $i < $enemyCharacterCount; $i++) {
            $enemyCharacter = Character::factory()->make([
                'enemy' => true,
            ]);
            $enemyCharacter->user()->associate($users->filter(fn ($user) => $user->admin)->random());
            $enemyCharacter->save();
            $enemyCharacters->push($enemyCharacter);
        }

        $places = collect();
        $placeCount = rand(10, 20);
        for ($i = 0; $i < $placeCount; $i++) {
            $places->push(Place::factory()->create());
        }

        $contests = collect();
        $contestCount = rand(10, 20);
        for ($i = 0; $i < $contestCount; $i++) {
            $contest = Contest::factory()->make();
            $contest->user()->associate($users->filter(fn ($user) => !$user->admin)->random());
            $contest->place()->associate($places->random());
            $contest->save();

            $isWin = $contest->win;
            $heroHp = 0;
            $enemyHp = 0;
            if ($isWin === true) {
                $heroHp = rand(1, 20);
            } elseif ($isWin === false) {
                $enemyHp = rand(1, 20);
            } else {
                $heroHp = rand(1, 20);
                $enemyHp = rand(1, 20);
            }

            $contest->characters()->attach([
                $characters->random(1)->first()->id => ['hero_hp' => $heroHp, 'enemy_hp' => $enemyHp],
                $enemyCharacters->random(1)->first()->id => ['hero_hp' => $heroHp, 'enemy_hp' => $enemyHp],
            ]);

            $contest->save();
            $contests->push($contest);
        }
    }
}
