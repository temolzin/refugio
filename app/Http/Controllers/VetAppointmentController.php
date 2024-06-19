<?php

namespace App\Http\Controllers;

use App\Models\VetAppointment;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VetAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $shelter = $user->shelter;
        $shelterId = $shelter->id;
        $status = VetAppointment::APPOINTMENT_STATUS;

        $animals = Animal::where('shelter_id', $shelterId)->get();
        $vets = VetAppointment::all();

        return view('vetappointments.index', compact('animals', 'vets', 'status'));
    }

    public function list()
    {
        $vets = VetAppointment::all();
        return $vets;
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'appointment_date_and_time' => 'required|date',
            'reason_for_appointment' => 'required|string|max:255',
            'appointment_status' => 'required|in:' .implode(',',VetAppointment::APPOINTMENT_STATUS),
            'observations' => 'nullable|string|max:255',

        ]);

        $vet = new VetAppointment();
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
        $vet = VetAppointment::find($id);
        if ($vet) {
            $vet->delete();
        }
        return redirect()->back()->with('success', 'Cita veterinaria eliminada exitosamente');
    }

    public function edit($id)
    {
        $vet = VetAppointment::find($id);
        return view('vetappointments.edit', compact('vet'));
    }

    public function create()
    {
        $status = VetAppointment::APPOINTMENT_STATUS;
        $vet = new VetAppointment();

        return view('vetappointments.create', compact('vet', 'status'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'appointment_date_and_time' => 'required|date',
            'reason_for_appointment' => 'required|string|max:255',
            'appointment_status' => 'required|in:' .implode(',',VetAppointment::APPOINTMENT_STATUS),
            'observations' => 'nullable|string|max:255',
        ]);

        $vet = VetAppointment::find($id);
        if ($vet) {
            $vet->update($request->all());
        }
        return redirect()->back()->with('success', 'Cita veterinaria actualizada correctamente');
    }

    public function show($id)
    {
        $vet = VetAppointment::find($id);
        return view('vetappointments.show', compact('vet'));
    }
}
