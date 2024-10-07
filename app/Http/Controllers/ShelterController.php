<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $shelters = Shelter::orderBy('created_at', 'desc')->get();
        $shelters->map(function ($shelter) {
            $shelter->logo_url = $shelter->getFirstMediaUrl('logos');
            return $shelter;
        });

        return view('shelters.index', compact('shelters','users'));
    }

    public function list()
    {
        $shelters = Shelter::all();
        return $shelters;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        if ($request->id == 0) {
            $shelter = new Shelter();
        } else {
            $shelter = Shelter::findOrFail($request->id);
        }

        $shelter->user_id = $request->input('user_id');
        $shelter->name = $request->input('name');
        $shelter->phone = $request->input('phone');
        $shelter->facebook = $request->input('facebook');
        $shelter->tiktok = $request->input('tiktok');
        $shelter->state = $request->input('state');
        $shelter->city = $request->input('city');
        $shelter->colony = $request->input('colony');
        $shelter->address = $request->input('address');
        $shelter->postal_code = $request->input('postal_code');

        if ($request->hasFile('logo')) {
            $shelter->addMediaFromRequest('logo')->toMediaCollection('logos');
        }
        $shelter->save();

        return redirect()->back()->with('success', 'Albergue guardado exitosamente');
    }

    public function destroy($id)
    {
        $shelter = Shelter::findOrFail($id);
        if ($shelter) {
            $shelter->clearMediaCollection('logos');
            $shelter->delete();
        }

        return redirect()->back()->with('success', 'Albergue eliminado exitosamente');
    }

    public function get(Request $request)
    {
        $shelter = Shelter::findOrFail($request->id);
        return $shelter;
    }

    public function edit($id)
    {
        $shelter = Shelter::findOrFail($id);
        $users = User::all();
        return view('shelters.edit', compact('shelter', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('shelters.create', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $shelter = Shelter::findOrFail($id);
        $shelter->user_id = $request->input('user_id');
        $shelter->name = $request->input('name');
        $shelter->phone = $request->input('phone');
        $shelter->facebook = $request->input('facebook');
        $shelter->tiktok = $request->input('tiktok');
        $shelter->state = $request->input('state');
        $shelter->city = $request->input('city');
        $shelter->colony = $request->input('colony');
        $shelter->address = $request->input('address');
        $shelter->postal_code = $request->input('postal_code');

        if ($request->hasFile('logo')) {
            $shelter->clearMediaCollection('logos');
            $shelter->addMediaFromRequest('logo')->toMediaCollection('logos');
        }
        $shelter->save();
        return redirect()->back()->with('success', 'Albergue actualizado correctamente');
    }

    public function show(Shelter $shelters)
    {
    }

    public function sheltersView()
    {
        $shelters = Shelter::all();
        return view('sheltersView', compact('shelters'));
    }
}
