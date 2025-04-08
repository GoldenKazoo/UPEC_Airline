<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class testcontroller extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|unique:clients,telephone',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|confirmed|min:6',
        ]
    );

        $client = Client::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


    }
    
    

}
