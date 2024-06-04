<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccineController extends Controller
{
    public function index(Request $request)
    {
        $vaccines = trim($request->get('text'));
        $vaccines = DB::table('vaccines')
            ->select('vaccine_id', 'name', 'type', 'description')
            ->where('vaccine_id', 'LIKE', '%' . $vaccines . '%')
            ->orWhere('name', 'LIKE', '%' . $vaccines . '%')
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
            'description' => 'required|string|max:255',
        ]);
        if ($request->vaccine_id == 0) {
            $vaccines = new Vaccine();
        } else {
            $vaccines = Vaccine::find($request->id);
        }
        $vaccines->name = $request->input('name');
        $vaccines->type = $request->input('type');
        $vaccines->description = $request->input('description');
        $vaccines->shelter_id = 1;
        $vaccines->save();

        return redirect()->back()->with('success', 'Vacuna guardada exitosamente');
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
            'description' => 'required|string|max:255',
        ]);
        $vaccines = Vaccine::find($vaccine_id);
        if ($vaccines) {
            $vaccines->name = $request->input('name');
            $vaccines->type = $request->input('type');
            $vaccines->description = $request->input('description');
            $vaccines->save();
        }
        return redirect()->back()->with('success', 'Vacuna actualizada correctamente');
    }

    public function show(Vaccine $vaccines)
    {

    }
}
