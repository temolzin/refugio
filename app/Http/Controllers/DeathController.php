<?php

namespace App\Http\Controllers;

use App\Models\Death;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeathController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id;

        $animals = Animal::where('Shelter_id', $shelterId)->get();
        $deaths = Death::where('shelter_id', $shelterId)->get();

        return view('deaths.index', compact('deaths', 'animals'));
    }


    public function list()
    {
        $deaths = Death::with('animal')->get();
        return response()->json($deaths);
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'date' => 'required|date',
            'cause' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        if (!$user || !$user->shelter) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $shelterId = $user->shelter->id;

        $death = new Death();
        $death->animal_id = $request->input('animal_id');
        $death->date = $request->input('date');
        $death->cause = $request->input('cause');
        $death->shelter_id = $shelterId;

        $death->save();

        return redirect()->route('deaths.index')->with('success', 'Fallecimiento guardado exitosamente.');
    }

    public function show($death_id)
    {
    }

    public function edit($death_id)
    {
    }

    public function update(Request $request, $death_id)
    {
        $request->validate([
            'animal_name' => 'required|string|max:255',
            'date' => 'required|date',
            'cause' => 'required|string|max:255',
            'animal_image' => 'nullable|image|max:2048', // Validación opcional para la imagen
        ]);

        $death = Death::findOrFail($death_id);
        $death->animal->animal_name = $request->input('animal_name');
        $death->date = $request->input('date');
        $death->cause = $request->input('cause');

        // Manejo de la imagen
        if ($request->hasFile('animal_image')) {
            // Eliminar imagen anterior si existe
            if ($death->animal->getFirstMedia('animal_gallery')) {
                $death->animal->clearMediaCollection('animal_gallery');
            }
            // Guardar la nueva imagen
            $death->animal->addMedia($request->file('animal_image'))->toMediaCollection('animal_gallery');
        }

        $death->animal->save();
        $death->save();

        return redirect()->route('deaths.index')->with('success', 'Fallecimiento actualizado exitosamente.');
    }

    public function destroy($death_id)
    {
        $death = Death::findOrFail($death_id);
        $death->delete();

        return redirect()->route('deaths.index')->with('success', 'Fallecimiento eliminado exitosamente.');
    }
}
