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
}
