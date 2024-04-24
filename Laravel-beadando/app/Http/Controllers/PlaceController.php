<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PlaceController extends Controller
{
    public function index()
    {
        if (!auth()->user()->admin) {
            return redirect()->route('index');
        }
        $places = Place::all();
        return view('components.place-index', [
            'places' => $places
        ]);
    }
    public function destroy($id)
    {
        if (!auth()->user()->admin) {
            return redirect()->route('index');
        }
        $place = Place::where('id', $id)->first();
        $image = $place->image;
        $image = str_replace('storage/', '', $image);
        Storage::disk('public')->delete($image);
        $place->delete();
        Session::flash('message', 'Place deleted');
        return redirect()->route('places.index');
    }
    public function edit($id)
    {
        if (!auth()->user()->admin) {
            return redirect()->route('index');
        }
        $place = Place::where('id', $id)->first();
        return view('components.place-edit', [
            'place' => $place
        ]);
    }
    public function update($id)
    {
        if (!auth()->user()->admin) {
            return redirect()->route('index');
        }
        $validated = request()->validate([
            'name' => 'required',
            'image' => 'image'
        ]);
        $place = Place::where('id', $id)->first();
        $place->name = $validated['name'];
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $fname = $file->hashName();
            Storage::disk('public')->put('images/' . $fname, $file->get());
            $place->image = "storage/images/" . $fname;
        }
        $place->save();
        return redirect()->route('places.index');
    }
    public function create()
    {
        if (!auth()->user()->admin) {
            return redirect()->route('index');
        }
        return view('components.place-create');
    }
    public function store(Request $request)
    {
        if (!auth()->user()->admin) {
            return redirect()->route('index');
        }
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'required|image'
        ]);
        $place = Place::make();
        $place->name = $validated['name'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fname = $file->hashName();
            Storage::disk('public')->put('images/' . $fname, $file->get());
            $validated['imagename'] = "storage/images/" . $fname;
        }
        $place->image = $validated['imagename'];
        $place->save();
        return redirect()->route('places.index');
    }
}
