<?php

namespace App\Http\Controllers;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{   
    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'start_date' => 'required|date',
            'finish_date' => 'required|date',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'shelter_member_id' => 'required|exists:shelter_member,id',
        ]);
    
        $sponsorship = new Sponsorship();
        $sponsorship->animal_id = $request->input('animal_id');
        $sponsorship->shelter_member_id = $request->input('shelter_member_id');
        $sponsorship->start_date = $request->input('start_date');
        $sponsorship->finish_date = $request->input('finish_date');
        $sponsorship->payment_date = $request->input('payment_date');
        $sponsorship->amount = $request->input('amount');
    
        $sponsorship->save();
    
        return redirect()->back()->with('success', 'Apadrinamiento registrado exitosamente.');
    }
    
    

    public function destroy($id)
    {
        $sponsorship = Sponsorship::find($id);
        $sponsorship->delete();
        return redirect()->back()->with('success', 'Apadrinamiento eliminada exitosamente');
    }

}
