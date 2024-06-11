<?php

namespace App\Http\Controllers;

use App\Enums\TypememberEnum;
use App\Models\Sheltermember;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class SheltermemberController extends Controller
{
    public function godfatherIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->shelter) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'padrino')
            ->where(function ($query) use ($request) {
                $text = trim($request->get('text'));
                $query->where('name', 'LIKE', '%' . $text . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $text . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        return view('sheltermembers.godfather', compact('sheltermember'));
    }

    public function donorIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->shelter) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'donante')
            ->where(function ($query) use ($request) {
                $text = trim($request->get('text'));
                $query->where('name', 'LIKE', '%' . $text . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $text . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        return view('sheltermembers.donor', compact('sheltermember'));
    }

    public function adopterIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->shelter) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'adoptante')
            ->where(function ($query) use ($request) {
                $text = trim($request->get('text'));
                $query->where('name', 'LIKE', '%' . $text . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $text . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        return view('sheltermembers.adopter', compact('sheltermember'));
    }

    public function staffIndex(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->shelter) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para ver esta página.');
        }

        $shelterId = $user->shelter->id;

        $sheltermember = Sheltermember::where('id_shelters', $shelterId)
            ->where('typemember', 'personal')
            ->where(function ($query) use ($request) {
                $text = trim($request->get('text'));
                $query->where('name', 'LIKE', '%' . $text . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $text . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        $sheltermember->map(function ($sheltermember) {
            $sheltermember->photo_url = $sheltermember->getFirstMediaUrl('photos');
            return $sheltermember;
        });

        return view('sheltermembers.staff', compact('sheltermember'));
    }

    public function list()
    {

        $sheltermember = Sheltermember::all();
        return $sheltermember;
    }

    public function store(Request $request)
    {
        $request->validate([
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
            'typemember' => 'required', new Enum(TypememberEnum::class),
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión para realizar esta acción.');
        }

        $shelter = $user->shelter;
        if (!$shelter) {
            return redirect()->back()->with('error', 'No se encontró el refugio asociado al usuario.');
        }

        if ($request->id == 0) {
            $sheltermember = new Sheltermember();
        } else {
            $sheltermember = Sheltermember::find($request->id);
            if (!$sheltermember) {
                return redirect()->back()->with('error', 'El miembro no fue encontrada.');
            }
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
        $sheltermember->typemember = $request->input('typemember');
        $sheltermember->id_shelters = $shelter->id;

        if ($request->hasFile('photo')) {
            $sheltermember->addMediaFromRequest('photo')->toMediaCollection('photos');
        }

        $sheltermember->save();

        return redirect()->back()->with('success', 'Miembro actualizado exitosamente.');
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
            'typemember' => 'required',
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
            $sheltermember->typemember = $request->input('typemember');

            $sheltermember->save();
        }
        return redirect()->back()->with('success', 'Miembro actualizada correctamente');
    }

    public function show(Sheltermember $sheltermember)
    {
    }
}
