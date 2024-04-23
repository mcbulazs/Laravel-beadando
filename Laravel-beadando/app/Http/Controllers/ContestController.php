<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Place;

class ContestController extends Controller
{
    function index($character_id)
    {
        $enemy = Character::where('enemy', true)->random();
        $character = Character::where('id', $character_id)->first();
        $place  = Place::all()->random();
        return view('contests.index', [
            'character' => $character,
            'enemy' => $enemy,
            'place' => $place
        ]);
    }
}
