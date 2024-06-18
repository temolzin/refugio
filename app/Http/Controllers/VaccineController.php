<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VaccineController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->shelter) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $shelterId = $user->shelter->id;

        $vaccines = Vaccine::where('shelter_id', $shelterId)
            ->where(function ($query) use ($request) {
                $text = trim($request->get('text'));
                $query->where('vaccine_id', 'LIKE', '%' . $text . '%')
                    ->orWhere('name', 'LIKE', '%' . $text . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('vaccines.index', compact('vaccines'));
    }

    public function list()
    {

        $vaccines = Vaccine::all();
        return $vaccines;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $shelter = $user->shelter;
        if (!$shelter) {
            return redirect()->back()->with('error', 'No se encontró el refugio asociado al usuario.');
        }

        if ($request->vaccine_id == 0) {
            $vaccines = new Vaccine();
        } else {
            $vaccines = Vaccine::find($request->vaccine_id);
            if (!$vaccines) {
                return redirect()->back()->with('error', 'La vacuna no fue encontrada.');
            }
        }

        $vaccines->name = $request->input('name');
        $vaccines->type = $request->input('type');
        $vaccines->description = $request->description;
        $vaccines->shelter_id = $shelter->id;

        $vaccines->save();

        return redirect()->back()->with('success', 'Vacuna guardada exitosamente.');

    }

    public function destroy($vaccine_id)
    {
        $vaccines = Vaccine::find($vaccine_id);
        $vaccines->delete();
        return redirect()->back()->with('success', 'Vacuna eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $vaccines = Vaccine::find($request->vaccine_id);
        return $vaccines;
    }

    public function edit($vaccine_id)
    {

    }

    public function update(Request $request, $vaccine_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required',
        ]);
        $vaccines = Vaccine::find($vaccine_id);
        if ($vaccines) {
            $vaccines->name = $request->input('name');
            $vaccines->type = $request->input('type');
            $vaccines->description = $request->description;
            $vaccines->save();
        }
        return redirect()->back()->with('success', 'Vacuna actualizada correctamente');
    }

    public function show(Vaccine $vaccines)
    {

    }
}
