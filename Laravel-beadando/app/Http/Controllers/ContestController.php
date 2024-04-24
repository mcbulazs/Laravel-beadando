<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    public function create($id)
    {
        if (!Auth::check()) {
            return redirect()->route('index');
        }
        $enemy = Character::where('enemy', true)->inRandomOrder()->first();
        $character = Character::where('id', $id)->first();
        $place  = Place::inRandomOrder()->first();
        if (!$character || !$enemy || !$place) {
            return redirect()->route('character.index');
        }
        $contest = Contest::make([
            'win' => null,
            'history' => ''
        ]);
        $contest->user()->associate(Auth::user());
        $contest->place()->associate($place);
        $contest->save();
        $contest->characters()->attach([
            $character->id => ['hero_hp' => 20, 'enemy_hp' => 20],
            $enemy->id => ['hero_hp' => 20, 'enemy_hp' => 20]
        ]);
        $contest->save();
        return redirect()->route('contests.show', ['contest' => $contest->id]);
    }
    public function show(string $id)
    {
        $contest = Contest::where('id', $id)->with('characters')->first();
        if ($contest->user->id !== Auth::id()) {
            return redirect()->route('index');
        }
        $characters = $contest->characters;
        $character = $characters->where('enemy', false)->first();
        $enemy = $characters->where('enemy', true)->first();
        $place = $contest->place;
        return view('components.contest-index', [
            'character' => $character,
            'enemy' => $enemy,
            'place' => $place,
            'contest' => $contest
        ]);
    }
    public function attack(Request $request, string $id, string $attackType)
    {
        $contest = Contest::where('id', $id)->with('characters')->first();
        if ($contest->user->id !== Auth::id()) {
            return redirect()->route('index');
        }
        $characters = $contest->characters;
        $hero = $characters->where('enemy', false)->first();
        $enemy = $characters->where('enemy', true)->first();

        //heroes turn
        $heroDmg = 0;
        switch ($attackType) {
            case 'melee':
                $heroDmg = $this->calculateMeleeDmg($hero, $enemy);
                break;
            case 'ranged':
                $heroDmg = $this->calculateRangedDmg($hero, $enemy);
                break;
            case 'magic':
                $heroDmg = $this->calculateMagicDmg($hero, $enemy);
                break;
            default:
                $heroDmg = 0;
                break;
        }
        if ($heroDmg < 0) {
            $heroDmg = 0;
        }
        $contest->history .= "~" . $hero->name . " deals " . $heroDmg . " " . $attackType . " dmg";
        foreach ($contest->characters as $character) {
            $character->pivot->enemy_hp -= $heroDmg;
            $character->pivot->save();
        }
        if ($contest->characters->first()->pivot->enemy_hp <= 0) {
            foreach ($contest->characters as $character) {
                $character->pivot->enemy_hp = 0;
                $character->pivot->save();
            }
            $contest->win = true;
            $contest->history .= "~Hero wins!";
            $contest->save();
            return redirect()->route('contests.show', ['contest' => $contest->id]);
        }

        //enemys turn
        $random = rand(1, 3);
        $enemyDmg = 0;
        $attackType = '';
        switch ($random) {
            case 1:
                $enemyDmg = $this->calculateMeleeDmg($enemy, $hero);
                $attackType = 'melee';
                break;
            case 2:
                $enemyDmg = $this->calculateRangedDmg($enemy, $hero);
                $attackType = 'ranged';
                break;
            case 3:
                $enemyDmg = $this->calculateMagicDmg($enemy, $hero);
                $attackType = 'magic';
                break;
            default:
                $enemyDmg = 0;
                break;
        }
        if ($enemyDmg < 0) {
            $enemyDmg = 0;
        }
        $contest->history .= "~" . $enemy->name . " deals " . $enemyDmg . " " . $attackType . " dmg";
        foreach ($contest->characters as $character) {
            $character->pivot->hero_hp -= $enemyDmg;
            $character->pivot->save();
        }
        if ($contest->characters->first()->pivot->hero_hp <= 0) {
            foreach ($contest->characters as $character) {
                $character->pivot->hero_hp = 0;
                $character->pivot->save();
            }
            $contest->win = false;
            $contest->history .= "~Enemy wins!";
            $contest->save();
            return redirect()->route('contests.show', ['contest' => $contest->id]);
        }
        $contest->save();
        return redirect()->route('contests.show', ['contest' => $contest->id]);
    }
    private function calculateMeleeDmg($ATT, $DEF)
    {
        return ($ATT->strength * 0.7) + ($ATT->accuracy * 0.1) + ($ATT->magic * 0.1) - $DEF->defence;
    }
    private function calculateRangedDmg($ATT, $DEF)
    {
        return ($ATT->accuracy * 0.7) + ($ATT->strength * 0.1) + ($ATT->magic * 0.1) - $DEF->defence;
    }
    private function calculateMagicDmg($ATT, $DEF)
    {
        return ($ATT->magic * 0.7) + ($ATT->accuracy * 0.1) + ($ATT->strength * 0.1) - $DEF->defence;
    }
}
