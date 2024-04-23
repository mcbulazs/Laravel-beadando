<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Character;
use App\Models\Contest;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    //TODO: admin can see and modify all enemies
    public function index()
    {
        //list only the characters the user owns
        $characters = Character::where('user_id', auth()->id())->get();
        //admin can see all character which has enemy set to true, and its own characters
        if (auth()->user()->is_admin) {
            $characters = Character::where('user_id', auth()->id())->orWhere('enemy', true)->get();
        }
        return view('components.character-list', [
            'characters' => $characters
        ]);
    }
    public function show(string $id)
    {
        //show the character
        $character = Character::where('id', $id)->first();
        //if enemy is true, admin can see the character
        if (!$character->enemy || !auth()->user()->is_admin) {
            $character = Character::where('user_id', auth()->id())->where('id', $id)->first();
        }
        $contests = Contest::where('user_id', auth()->id())->with('characters')->get();
        return view('components.character-show', [
            'character' => $character,
            'contests' => $contests
        ]);
    }
    public function edit($id)
    {
        //edit the character
        //admin can edit enemy characters
        $character = Character::where('id', $id)->first();
        if ($character->enemy && auth()->user()->is_admin) {
            return view('components.character-edit', [
                'character' => $character
            ]);
        }
        $character = Character::where('user_id', auth()->id())->where('id', $id)->first();
        return view('components.character-edit', [
            'character' => $character
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'defence' => 'required|numeric|min:0|max:3',
            'strength' => 'required|numeric|min:0|max:20',
            'accuracy' => 'required|numeric|min:0|max:20',
            'magic' => 'required|numeric|min:0|max:20',
        ]);
        $sum = $validated['defence'] + $validated['strength'] + $validated['accuracy'] + $validated['magic'];
        if ($sum > 20) {
            return redirect()->back()->withErrors(['The sum of defence, strength, accuracy, and magic must be less than or equal to 20.']);
        }
        $character = Character::where('user_id', auth()->id())->where('id', $id)->first();
        $character->update($validated);
        //update the character

        Session::flash("success", "Character edited successfully");

        return redirect()->route('characters.show', ['character' => $character->id]);
    }
    public function destroy($id)
    {
        //delete the character
        $character = Character::where('id', $id)->first();
        if (!$character->enemy || !auth()->user()->is_admin) {
            $character = Character::where('user_id', auth()->id())->where('id', $id)->first();
        }
        $character->delete();
        Session::flash("success", "Character deleted successfully");
        return redirect()->route('characters.index');
    }
    public function create()
    {
        //create a new character
        return view('components.character-create', [
            'isAdmin' => auth()->user()->is_admin
        ]);
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'defence' => 'required|numeric|min:0|max:3',
            'strength' => 'required|numeric|min:0|max:20',
            'accuracy' => 'required|numeric|min:0|max:20',
            'magic' => 'required|numeric|min:0|max:20',
        ]);
        $sum = $validated['defence'] + $validated['strength'] + $validated['accuracy'] + $validated['magic'];
        if ($sum > 20) {
            return redirect()->back()->withErrors(['The sum of defence, strength, accuracy, and magic must be less than or equal to 20.']);
        }

        $validated['enemy'] = $request->has('enemy') ? $request->get('enemy') : false;
        $character = Character::make($validated);
        $character->user()->associate(Auth::user());
        $character->save();
        //update the character

        Session::flash("success", "Character created successfully");

        return redirect()->route('characters.show', ['character' => $character->id]);
    }
}
