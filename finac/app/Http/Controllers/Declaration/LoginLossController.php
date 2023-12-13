<?php

namespace App\Http\Controllers\Declaration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\PermissionsPort;

class LoginLossController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_finac' => 'required',
            'numero_serie' => 'required',
        ]);

        // Vérifier les informations d'identification
        $credentials = $request->only('code_finac', 'numero_serie');
        if (PermissionsPort::where($credentials)->exists()) {
            // Informations correctes, rediriger vers la page LOssWeapons
            return redirect()->route('declaration.LossDeclaration');
        } else {
            // Informations incorrectes, afficher un message d'erreur
            return back()->with('error', 'Code Finac ou Numero de Serie incorrect.');
        }
    }
}
