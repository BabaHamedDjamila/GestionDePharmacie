<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceuilleController extends Controller
{
    public function Acceuille()
    {
        return view('usercovid.Acceuille');
    }
    
}
