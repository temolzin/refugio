<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;

class RefugeController extends Controller
{
    public function index()
    {
        $shelters=Shelter::all();
        return view('refuges', compact('shelters'));

    }
}
