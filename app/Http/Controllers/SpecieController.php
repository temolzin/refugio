<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SpecieController extends Controller
{

    public function index(Request $request)
    {
         $species = trim($request->get('text'));
         $species = DB::table('species')
            ->select('id','name' ,'description')
            ->where('id', 'LIKE', '%' . $species . '%')
            ->orWhere('name', 'LIKE', '%' . $species. '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

    return view('species.index', compact('species'));
    }


    public function list(){

    $species = Specie::all();
    return $species;

    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        if ($request->id == 0) {
            $species = new Specie();
        } else {
            $species = Specie::find($request->id);
            if (!$species) {
                return redirect()->back()->with('error', 'La especie no fue encontrada');
            }
        }
        $species->name = $request->input('name');
        $species->description = $request->input('description');
        $species->id_shelters = 2;
    
        $species->save();

        return redirect()->back()->with('success', 'Especie guardada exitosamente');
    }
    

    public function destroy($id)
    {
        $species= Specie::find($id);
        $species->delete();
        return redirect ()->back()->with('success','Especie eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $species = Specie::find($request->id);
        return $species;
    }

    public function edit($id)
    {
   
    }

    public function update(Request $request, $id)
    {
        $request->validate([
         'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        ]);
         $species = Specie::find($id);
        if ($species)
        {
         $species->name = $request->input('name');
         $species->description = $request->input('description');
         $species->save();
        }
        return redirect()->back()->with('success', 'Especie actualizada correctamente');
    }

    public function show(Specie $species)
    {

    }
}
