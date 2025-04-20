<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LogController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function createForm()
    {
        return view('auth.register'); // Assurez-vous que cette vue existe
    }

    // Méthode pour traiter l'inscription
    public function register(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email', // Ajoutez la règle d'unicité ici
            'password' => 'required|min:4'
        ]);

        // Créer un nouvel utilisateur
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('auth.loginForm')->with('success', 'Registration successful. Please log in.');
    }

    // Méthode pour afficher le formulaire de connexion
    public function login()
    {
        return view('auth.login'); // Assurez-vous que cette vue existe
    }

    // Méthode pour traiter la connexion
    public function doLogin(Request $request)
    {
        // Ajoutez votre logique de connexion ici
    }

    // Méthode pour afficher la page du compte
    public function account()
    {
        return view('auth.account');
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout(Request $request)
    {
        // Ajoutez votre logique de déconnexion ici
    }
}


