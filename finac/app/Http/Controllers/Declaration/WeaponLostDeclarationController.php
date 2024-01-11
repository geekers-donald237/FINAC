<?php

namespace App\Http\Controllers\Declaration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\MailController;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\declaration\WeaponLostDeclaration;
use App\Models\PermissionsPort;
use App\Models\weapons\Weapon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;


class WeaponLostDeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($serialNumber)
    {
        return view('weaponsdeclaration.lost_weapon', compact('serialNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $surname = $request->surname;
            $serialNumber = $request->serialNumber;
            $phone_number = $request->phone_number;
            $email = $request->email;
            $adresse = $request->adresse;
            $date = $request->date;
            $description = $request->description;

            // Vérifier si tous les champs nécessaires sont remplis
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $surname, $phone_number, $email, $adresse, $date, $description])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $new_declaration = new WeaponLostDeclaration();
            $new_declaration->id = Uuid::uuid4()->toString();
            $new_declaration->name = $name;
            $new_declaration->surname = $surname;
            $new_declaration->phone_number = $phone_number;
            $new_declaration->email = $email;
            $new_declaration->adresse = $adresse;
            $new_declaration->date = $date;
            $new_declaration->description = $description;
            $new_declaration->save();

            // Vérifier si une arme avec le numéro de série existe
            $weapon = Weapon::where('serial_number', $serialNumber)->first();

            if ($weapon) {
                // Mettre à jour le statut de l'arme à 'isLost'
                $weapon->isLost = true;
                $weapon->save();
            }

            $subject = 'Declaration de pertes d\'armes';
            MailController::sendWeaponDeclarationMail($email, $subject, $weapon->weaponType->type, $serialNumber, false);
            toastr()->success('Déclaration enregistrée avec succès');
             return redirect()->route('home');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @throws \Exception
     */
    public function checkIfweaponExistOrNot(Request $request)
    {
        $code_finac = $request->code_finac;

        if (HelpersFunction::checkValueOfArrayIsEmpty([$code_finac])) {
            throw new \Exception('Veuillez remplir tous les champs');
        }

        // Vérifier le code_finac dans la table permissionsPort
        $permissionsPort = PermissionsPort::where('code_finac', $code_finac)->first();


        if ($permissionsPort) {
            // Récupérer le serial_number associé à ce code_finac
//            $serial_number = $permissionsPort->serial_number;
//
//            $weapon = WT::where('id', $permissionsPort->weapon_id)
//                ->where('serial_number', $serial_number)
//                ->first();
//
//            if ($weapon) {
//                $weapon->update(['isLost' => true]);
//                $permissionsPort->update(['isLost' => true]);
//
//                return redirect()->route('declaration.loss_weapon');
//            }
            $serialNumber = Weapon::getSerialNumberByWeaponId($permissionsPort->weapon_id);

            return redirect()->route('declaration.loss_weapon' , encrypt($serialNumber));

        }

        toastr()->error('Code finac incorrect');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



// public function checkIfweaponExistOrNot(Request $request)
// {
//     $code_finac = $request->code_finac;

//     if (HelpersFunction::checkValueOfArrayIsEmpty([$code_finac])) {
//         throw new \Exception('Veuillez remplir tous les champs');
//     }

//     // Vérifier le code_finac dans la table permissionsPort
//     $permissionsPort = PermissionsPort::firstWhere('code_finac', $code_finac);

//     if ($permissionsPort) {
//         // Récupérer le modèle Weapon associé
//         $weapon = $permissionsPort->weapon;

//         if ($weapon) {
//             $serial_number = $weapon->serial_number;

//             // Recherchez l'entrée dans la table WT en utilisant le serial_number
//             $weapons = WT::where('serial_number', $serial_number)->first();

//             if ($weapons) {
//                 return redirect()->route('declaration.loss_weapon');
//             }
//         }
//     }

//     toastr()->error('Code finac');
//     return redirect()->back();
// }


}
