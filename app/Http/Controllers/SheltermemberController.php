<?php

namespace App\Http\Controllers;

use App\Models\Sheltermember;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheltermemberController extends Controller
{
    public function godfatherIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'Padrino')
            ->get();
        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        $typemember = 'Padrino';
        return view('sheltermembers.godfather', compact('sheltermember', 'typemember'));
    }

    public function donorIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'Donante')
            ->get();
        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        $typemember = 'Donante';
        return view('sheltermembers.donor', compact('sheltermember', 'typemember'));
    }

    public function adopterIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'Adoptante')
            ->get();
        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        $typemember = 'Adoptante';
        return view('sheltermembers.adopter', compact('sheltermember', 'typemember'));
    }

    public function staffIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'Personal')
            ->get();
        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        $typemember = 'Personal';

        return view('sheltermembers.staff', compact('sheltermember', 'typemember'));
    }


    public function list()
    {

        $sheltermember = Sheltermember::all();
        return $sheltermember;
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mother_lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'typemember' => 'required|in:Adoptante,Donante,Padrino,Personal',
        ]);

        $user = Auth::user();

        $shelter = $user->shelter;
       
        $sheltermember = new Sheltermember();
        $sheltermember->name = $request->input('name');
        $sheltermember->last_name = $request->input('last_name');
        $sheltermember->mother_lastname = $request->input('mother_lastname');
        $sheltermember->phone = $request->input('phone');
        $sheltermember->email = $request->input('email');
        $sheltermember->state = $request->input('state');
        $sheltermember->city = $request->input('city');
        $sheltermember->colony = $request->input('colony');
        $sheltermember->address = $request->input('address');
        $sheltermember->postal_code = $request->input('postal_code');
        $sheltermember->typemember = $request->input('typemember');
        $sheltermember->id_shelters = $shelter->id;

        if ($request->hasFile('photo')) {
            $sheltermember->addMediaFromRequest('photo')->toMediaCollection('photos');
        }

        $sheltermember->save();

        return redirect()->back()->with('success', 'Miembro registrado exitosamente.');
    }

    public function destroy($id)
    {
        $sheltermember = Sheltermember::find($id);
        if ($sheltermember) {
            $sheltermember->clearMediaCollection('photos');
            $sheltermember->delete();
        }
        return redirect()->back()->with('success', 'Miembro eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $sheltermember = Sheltermember::find($request->id);
        return $sheltermember;
    }

    public function edit($id)
    {
        $sheltermember = Sheltermember::find($id);
        return view('Sheltermembers.info', compact('sheltermember'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mother_lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);
        $sheltermember = Sheltermember::find($id);
        if ($sheltermember) {
            $sheltermember->update($request->except('photo'));
            if ($request->hasFile('photo')) {
                $sheltermember->clearMediaCollection('photos');
                $sheltermember->addMediaFromRequest('photo')->toMediaCollection('photos');
            }
            $sheltermember->name = $request->input('name');
            $sheltermember->last_name = $request->input('last_name');
            $sheltermember->mother_lastname = $request->input('mother_lastname');
            $sheltermember->phone = $request->input('phone');
            $sheltermember->email = $request->input('email');
            $sheltermember->state = $request->input('state');
            $sheltermember->city = $request->input('city');
            $sheltermember->colony = $request->input('colony');
            $sheltermember->address = $request->input('address');
            $sheltermember->postal_code = $request->input('postal_code');

            $sheltermember->save();
        }
        return redirect()->back()->with('success', 'Miembro actualizada correctamente');
    }

    public function show(Sheltermember $sheltermember)
    {
    }
}
