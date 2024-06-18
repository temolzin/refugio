<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VetController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id;
        $status = Vet::APPOINTMENT_STATUS;

        $animals = Animal::where('shelter_id', $shelterId)->get();
        $vets = Vet::all();

        return view('vets.index', compact('animals', 'vets', 'status'));
    }

    public function list()
    {
        $vets = Vet::all();
        return $vets;
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'appointment_date_and_time' => 'required|date',
            'reason_for_appointment' => 'required|string|max:255',
            'appointment_status' => 'required|in:' .implode(',',Vet::APPOINTMENT_STATUS),
            'observations' => 'nullable|string|max:255',

        ]);

        $vet = new Vet();
        $vet->animal_id = $request->input('animal_id');
        $vet->appointment_date_and_time = $request->input('appointment_date_and_time');
        $vet->reason_for_appointment = $request->input('reason_for_appointment');
        $vet->appointment_status = $request->input('appointment_status');
        $vet->observations = $request->input('observations');

        $vet->save();

        return redirect()->back()->with('success', 'Cita veterinaria guardada exitosamente');
    }

    public function destroy($id)
    {
        $vet = Vet::find($id);
        if ($vet) {
            $vet->delete();
        }
        return redirect()->back()->with('success', 'Cita veterinaria eliminada exitosamente');
    }

    public function edit($id)
    {
        $vet = Vet::find($id);
        return view('vets.edit', compact('vet'));
    }

    public function create()
    {
        $status = Vet::APPOINTMENT_STATUS;
        $vet = new Vet();

        return view('vets.create', compact('vet', 'status'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'appointment_date_and_time' => 'required|date',
            'reason_for_appointment' => 'required|string|max:255',
            'appointment_status' => 'required|in:' .implode(',',Vet::APPOINTMENT_STATUS),
            'observations' => 'nullable|string|max:255',
        ]);

        $vet = Vet::find($id);
        if ($vet) {
            $vet->update($request->all());
        }
        return redirect()->back()->with('success', 'Cita veterinaria actualizada correctamente');
    }

    public function show($id)
    {
        $vet = Vet::find($id);
        return view('vets.show', compact('vet'));
    }
}
