<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = trim($request->get('texto'));
        $users = DB::table('users')
            ->select('id', 'name','last_name','maternal_lastName','phone','email','password') 
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

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'maternal_lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',      
        ]);

        if ($req->id ==0)
        {
            $users = new Users();
        }else
        {
            $users = Users::find($req->id);
        }

        $users->name =$req ->input ('name');
        $users->last_name =$req ->input ('last_name');
        $users->maternal_lastName =$req ->input ('maternal_lastName');
        $users->phone =$req ->input ('phone');
        $users->email =$req ->input ('email');
        $users->password = bcrypt($req->input('password'));
        $users->save();

        return redirect()->back()->with('success', 'Usuario guardado exitosamente');
    }

    public function destroy($id)
    {
        $users= Users::find($id);
        $users->delete();
        return redirect ()->back()->with('success','Formulario eliminado exitosamente');
    }

    public function get(Request $req)
    {
        $users = Users::find($req->id);
        return $users;
    }

   public function edit($id)
    {
       
    }

   public function update(Request $req, $id)
   {
       $req->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'maternal_lastName' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|string|email|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|min:8',      
        ]);
        $users = Users::find($id);

       if ($users) {
           $users->name = $req->input('name');
           $users->last_name = $req->input('last_name');
           $users->maternal_lastName = $req->input('maternal_lastName');
           $users->phone =$req ->input('phone');
           $users->email =$req ->input('email');
           $users->email_verified_at = $req->input('email_verified_at') ? $req->input('email_verified_at') : null;
           $users->password = bcrypt($req->input('password'));
           $users->save();
       }
   
       return redirect()->back()->with('success', 'Usuario actualizado correctamente');
   }


   
   public function show(Users $users)
   {
    
   }
}
