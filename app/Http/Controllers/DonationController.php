<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'shelter_member_id' => 'required|exists:shelter_member,id',
            'donation_date' => 'required|date',
            'type' => 'required|in:' .implode(',',Donation::DONATION),
            'amount' => 'required|numeric',
            'observation' => 'required|string|max:255'
        ]);

        $donation = new Donation();
        $donation->shelter_member_id = $request->input('shelter_member_id');
        $donation->donation_date = $request->input('donation_date');
        $donation->type = $request->input('type');
        $donation->amount = $request->input('amount');
        $donation->observation = $request->input('observation');
        $donation->save();

        return redirect()->back()->with('success', 'Donación registrada exitosamente');
    }

    public function destroy($id, Request $request)
    {
        $donation = Donation::find($id);
        $donation->delete();

        return redirect()->back()->with('success', 'Donacion eliminada exitosamente')->with('modal_id', $request->input('modal_id'));
    }
}
