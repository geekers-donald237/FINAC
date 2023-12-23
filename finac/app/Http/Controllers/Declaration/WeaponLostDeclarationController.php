<?php

namespace App\Http\Controllers\Declaration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\declaration\WeaponLostDeclaration;
use App\Models\PermissionsPort;
use App\Models\weapons\Weapon as WT;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DeclarationConfirmationMail;


class WeaponLostDeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('weaponsdeclaration.lost_weapon');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $surname = $request->surname;
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

            $sendemail = $new_declaration->email; // Récupérez l'adresse e-mail depuis l'objet que vous venez d'enregistrer

            Mail::to($sendemail)->send(new DeclarationConfirmationMail()); // Utilisez votre classe de mèl pour la confirmation



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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $serial_number = $request->serial_number;

        if (HelpersFunction::checkValueOfArrayIsEmpty([$code_finac, $serial_number])) {
            throw new \Exception('Veuillez remplir tous les champs');
        }

        // Vérifier le code_finac dans la table permissionsPort
        $permissionsPort = PermissionsPort::firstWhere('code_finac', $code_finac);

        if ($permissionsPort) {
            $weapons = WT::where('id', $permissionsPort->weapon_id)
                ->where('serial_number', $serial_number)
                ->first();

            if ($weapons) {
                return redirect()->route('declaration.loss_weapon');
            }
        }
        toastr()->error('code finac ou numero de serie incorrecte');
        return redirect()->back();
    }

}
