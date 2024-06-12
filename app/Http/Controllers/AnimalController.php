<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use App\Models\Specie;
use Illuminate\Http\Request;

class AnimalController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id;

        $origins = Animal::ORIGINS;
        $behaviors = Animal::BEHAVIORS;
        $sexs = Animal::SEXS;
        $animals = Animal::where('shelter_id', $shelterId)->get();
        $species = Specie::where('id_shelters', $shelterId)->get();

        return view('animals.index', compact('animals', 'species','origins', 'behaviors','sexs'));
    }

    public function create()
    {
        $species = Specie::all();
        return view('animals.create', compact('species'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'animal_name' => 'required|string|max:255',
            'specie_id' => 'required|exists:species,id',
            'breed' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'sex' => 'required|in:Macho,Hembra',
            'color' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'is_sterilized' => 'required|in:Si,No',
            'entry_date' => 'required|date',
            'origin' => 'required|in:Rescatado,Transferido,Abandonado',
            'behavior' => 'required|in:Amigable,Timido,Agresivo',
            'history' => 'required|string',
        ]);

        $user = Auth::user();
        $shelter = $user->shelter;

        $animal = new Animal();
        $animal->specie_id = $request->specie_id;
        $animal->shelter_id = $shelter->id;
        $animal->animal_name = $request->animal_name;
        $animal->breed = $request->breed;
        $animal->birth_date = $request->birth_date;
        $animal->sex = $request->sex;
        $animal->color = $request->color;
        $animal->weight = $request->weight;
        $animal->is_sterilized = $request->is_sterilized;
        $animal->entry_date = $request->entry_date;
        $animal->origin = $request->origin;
        $animal->behavior = $request->behavior;
        $animal->history = $request->history;

        $animal->save();

        if ($request->hasFile('photo')) {
            $animal->addMediaFromRequest('photo')->toMediaCollection('animal_gallery');
        }

        return redirect()->route('animals.index')->with('success', 'Mascota agregada correctamente.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'animal_name' => 'required|string|max:255',
            'specie_id' => 'required|exists:species,id',
            'breed' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'sex' => 'required|in:Macho,Hembra',
            'color' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'is_sterilized' => 'required|in:Si,No',
            'entry_date' => 'required|date',
            'origin' => 'required|in:Rescatado,Transferido,Abandonado',
            'behavior' => 'required|in:Amigable,Timido,Agresivo',
            'history' => 'required|string',
        ]);

        $animal->update($request->except('photo'));

        if ($request->hasFile('photo')) {
            $animal->clearMediaCollection('animal_gallery');
            $animal->addMediaFromRequest('photo')->toMediaCollection('animal_gallery');
        }

        return redirect()->route('animals.index')->with('success', 'Mascota actualizada correctamente.');
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return redirect()->back()->with('success', 'Mascota eliminada exitosamente');
    }
}
