<?php

namespace App\Http\Controllers\Declaration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\PermissionsPort;
use App\Models\weapons\Weapon as WT;
use App\Models\weapons\WeaponType;
use App\Http\Controllers\weapons\WeaponsType; // Assurez-vous que le chemin est correct

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
            'serial_number' => 'required',
        ]);

        // Vérifier les informations d'identification
        $credentials = $request->only('code_finac', 'serial_number');

        // Vérifier le code_finac dans la table permissionsPort
        $permissionsPort = PermissionsPort::firstWhere('code_finac', $credentials['code_finac']);

        if ($permissionsPort) {
            // Vérifier que le numero_serie existe pour cet id_weapons dans la table Weapons
            $weapons = WT::where('id', $permissionsPort->weapon_id)
                ->where('serial_number', $credentials['serial_number'])
                ->first();

            if ($weapons) {
                // Informations correctes, rediriger vers la page LossDeclaration
                return redirect()->route('declaration.LossDeclaration');
            }
        }

        // Informations incorrectes, afficher un message d'erreur
        return back()->with('error', 'Code Finac ou Numero de Serie incorrect.');
    }
}
