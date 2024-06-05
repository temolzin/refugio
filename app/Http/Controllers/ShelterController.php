<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index(Request $request)
    {
        $shelters = trim($request->get('text'));
        $shelters = Shelter::with('users')
            ->select('id', 'user_id', 'name', 'logo', 'phone', 'facebook', 'tiktok', 'state', 'city', 'colony', 'address', 'postal_code')
            ->where('id', 'LIKE', '%' . $shelters . '%')
            ->orWhere('name', 'LIKE', '%' . $shelters . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        $shelters->map(function ($shelter) {
            $shelter->logo_url = $shelter->getFirstMediaUrl('logos');
            return $shelter;
        });

        return view('shelters.index', compact('shelters'));
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
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
            $shelters = new Shelter();
        } else {
            $shelters = Shelter::find($request->id);
        }

        $shelters->user_id = $request->input('user_id');
        $shelters->name = $request->input('name');
        $shelters->phone = $request->input('phone');
        $shelters->facebook = $request->input('facebook');
        $shelters->tiktok = $request->input('tiktok');
        $shelters->state = $request->input('state');
        $shelters->city = $request->input('city');
        $shelters->colony = $request->input('colony');
        $shelters->address = $request->input('address');
        $shelters->postal_code = $request->input('postal_code');

        if ($request->hasFile('logo')) {
            $shelters->addMediaFromRequest('logo')->toMediaCollection('logos');
        }

        $shelters->save();

        return redirect()->back()->with('success', 'Albergue guardado exitosamente');
    }

    public function destroy($id)
    {
        $shelters = Shelter::find($id);
        if ($shelters) {
            $shelters->clearMediaCollection('logos');
            $shelters->delete();
        }
        return redirect()->back()->with('success', 'Albergue eliminado exitosamente');
    }

    public function get(Request $request)
    {
        $shelters = Shelter::find($request->id);
        return $shelters;
    }

    public function edit($id)
    {
        $shelter = Shelter::find($id);
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string|max:15',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $shelters = Shelter::find($id);
        if ($shelters) {
            $shelters->update($request->except('logo'));
            if ($request->hasFile('logo')) {
                $shelters->clearMediaCollection('logos');
                $shelters->addMediaFromRequest('logo')->toMediaCollection('logos');
            }
            $shelters->user_id = $request->input('user_id');
            $shelters->name = $request->input('name');
            $shelters->logo = $request->input('logo');
            $shelters->phone = $request->input('phone');
            $shelters->facebook = $request->input('facebook');
            $shelters->tiktok = $request->input('tiktok');
            $shelters->state = $request->input('state');
            $shelters->city = $request->input('city');
            $shelters->colony = $request->input('colony');
            $shelters->address = $request->input('address');
            $shelters->postal_code = $request->input('postal_code');
            $shelters->save();
        }
        return redirect()->back()->with('success', 'Albergue actualizado correctamente');
    }

    public function show(Shelter $shelters)
    {
        
    }
}
