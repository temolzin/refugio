<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = trim($request->get('text'));
        $users = DB::table('users')
            ->select('id', 'name','last_name','phone','email','password')
            ->where('id', 'LIKE', '%' . $users . '%')
            ->orWhere('name', 'LIKE', '%' . $users . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);
    
        return view('users.index', compact('users'));
    }
    
    
    public function list(){

        $users = Users::all();
        return $users;

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if ($request->id == 0) {
            $users = new Users();
        } else {
            $users = Users::find($request->id);
        }
        $users->name =$request ->input ('name');
        $users->last_name =$request ->input ('last_name');
        $users->phone =$request ->input ('phone');
        $users->email =$request ->input ('email');
        $users->password = bcrypt($request->input('password'));
        $users->save();

        return redirect()->back()->with('success', 'Usuario guardado exitosamente');
    }

    public function destroy($id)
    {
        $users= Users::find($id);
        $users->delete();
        return redirect ()->back()->with('success','Usuario eliminado exitosamente');
    }

    public function get(Request $request)
    {
        $users = Users::find($request->id);
        return $users;
    }

   public function edit($id)
    {
       
    }

   public function update(Request $request, $id)
   {
       $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|string|email|max:255',
        'email_verified_at' => 'nullable',
        ]);
        $users = Users::find($id);
       if ($users) {
           $users->name = $request->input('name');
           $users->last_name = $request->input('last_name');
           $users->phone =$request ->input('phone');
           $users->email =$request ->input('email');
           $users->email_verified_at = $request->input('email_verified_at') ? $request->input('email_verified_at') : null;
           $users->save();
       }
       return redirect()->back()->with('success', 'Usuario actualizado correctamente');
   }

   public function show(Users $users)
   {
    
   }
}
