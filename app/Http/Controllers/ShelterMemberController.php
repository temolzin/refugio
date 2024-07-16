<?php

namespace App\Http\Controllers;

use App\Models\ShelterMember;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;

class ShelterMemberController extends Controller
{
    public function godfatherIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $shelterMember = ShelterMember::where('shelter_id', $shelterId)
            ->where('type_member',ShelterMember::TYPE_MEMBER_GODFATHER)
            ->get();
        $shelterMember->map(function ($shelterMember) {
            $shelterMember->photo_url = $shelterMember->getFirstMediaUrl('photos');
            return $shelterMember;
        });

        $typeMember = ShelterMember::TYPE_MEMBER_GODFATHER;

        return view('shelterMembers.godfather', compact('shelterMember', 'typeMember'));
    }

    public function donorIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $shelterMember = ShelterMember::where('shelter_id', $shelterId)
            ->where('type_member',ShelterMember::TYPE_MEMBER_DONOR)
            ->get();
           
        $shelterMember->map(function ($shelterMember) {
            $shelterMember->photo_url = $shelterMember->getFirstMediaUrl('photos');
            return $shelterMember;
        });
        
        $donations = Donation::all();
        $type = Donation::DONATION;
        $typeMember = ShelterMember::TYPE_MEMBER_DONOR;
        return view('shelterMembers.donor', compact('shelterMember', 'typeMember', 'type', 'donations'));
    }

    public function adopterIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $shelterMember = ShelterMember::where('shelter_id', $shelterId)
            ->where('type_member',ShelterMember::TYPE_MEMBER_ADOPTER)
            ->get();
        $shelterMember->map(function ($shelterMember) {
            $shelterMember->photo_url = $shelterMember->getFirstMediaUrl('photos');
            return $shelterMember;
        });

        $typeMember = ShelterMember::TYPE_MEMBER_ADOPTER;
        return view('shelterMembers.adopter', compact('shelterMember', 'typeMember'));
    }

    public function staffIndex(Request $request)
    {
        $user = Auth::user();

        $shelterId = $user->shelter->id;

        $shelterMember = ShelterMember::where('shelter_id', $shelterId)
            ->where('type_member', ShelterMember::TYPE_MEMBER_STAFF)
            ->get();
        $shelterMember->map(function ($shelterMember) {
            $shelterMember->photo_url = $shelterMember->getFirstMediaUrl('photos');
            return $shelterMember;
        });

        $typeMember = ShelterMember::TYPE_MEMBER_STAFF;

        return view('shelterMembers.staff', compact('shelterMember', 'typeMember'));
    }


    public function list()
    {

        $shelterMember = ShelterMember::all();
        return $shelterMember;
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'type_member' => 'required|in:' . implode(',', ShelterMember::TYPE_MEMBER),
        ]);

        $user = Auth::user();

        $shelter = $user->shelter;
       
        $shelterMember = new ShelterMember();
        $shelterMember->name = $request->input('name');
        $shelterMember->last_name = $request->input('last_name');
        $shelterMember->phone = $request->input('phone');
        $shelterMember->email = $request->input('email');
        $shelterMember->state = $request->input('state');
        $shelterMember->city = $request->input('city');
        $shelterMember->colony = $request->input('colony');
        $shelterMember->address = $request->input('address');
        $shelterMember->postal_code = $request->input('postal_code');
        $shelterMember->type_member = $request->input('type_member');
        $shelterMember->shelter_id = $shelter->id;

        if ($request->hasFile('photo')) {
            $shelterMember->addMediaFromRequest('photo')->toMediaCollection('photos');
        }

        $shelterMember->save();

        return redirect()->back()->with('success', 'Miembro registrado exitosamente.');
    }

    public function destroy($id)
    {
        $shelterMember = Sheltermember::find($id);
        if ($shelterMember) {
            $shelterMember->clearMediaCollection('photos');
            $shelterMember->delete();
        }
        return redirect()->back()->with('success', 'Miembro eliminada exitosamente');
    }

    public function get(Request $request)
    {
        $shelterMember = ShelterMember::find($request->id);
        return $shelterMember;
    }

    public function edit($id)
    {
        $shelterMember = ShelterMember::find($id);
        return view('shelterMembers.info', compact('shelterMember'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);
        $shelterMember = ShelterMember::find($id);
        if ($shelterMember) {
            $shelterMember->update($request->except('photo'));
            if ($request->hasFile('photo')) {
                $shelterMember->clearMediaCollection('photos');
                $shelterMember->addMediaFromRequest('photo')->toMediaCollection('photos');
            }
            $shelterMember->name = $request->input('name');
            $shelterMember->last_name = $request->input('last_name');
            $shelterMember->phone = $request->input('phone');
            $shelterMember->email = $request->input('email');
            $shelterMember->state = $request->input('state');
            $shelterMember->city = $request->input('city');
            $shelterMember->colony = $request->input('colony');
            $shelterMember->address = $request->input('address');
            $shelterMember->postal_code = $request->input('postal_code');

            $shelterMember->save();
        }
        return redirect()->back()->with('success', 'Miembro actualizada correctamente');
    }

    public function show(ShelterMember $shelterMember)
    {
    }
}
