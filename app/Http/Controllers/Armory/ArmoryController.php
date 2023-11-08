<?php

namespace App\Http\Controllers\Armory;

use App\Http\Controllers\Controller;
use App\Models\armory\Armory;
use App\Models\armory\HolderWeapon;
use App\Models\User;
use App\Models\weapons\PermissionsPort;
use App\Models\weapons\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArmoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $sector = $request->sector;
            $address = $request->address;
            $email = $request->email;
            $mailbox = $request->mailbox;
            $phone_number = $request->phone_number;
            $agrement = $request->agrement_number;
            $id_town = $request->id_town;
            $id_state = $request->id_state;
            $license = $request->license;

            if (
                empty($name) ||
                empty($sector) ||
                empty($address) ||
                empty($email) ||
                empty($mailbox) ||
                empty($phone_number) ||
                empty($agrement) ||
                empty($id_town) ||
                empty($id_state) || empty($license)
            ){
                var_dump('Veuillez remplir tous les champs');
                return redirect()->back();
            }
            $new_armory = new Armory();
            if ($request->hasFile('licence')) {
                $uploadedFile = $request->file('license');
                $filename = time() . $uploadedFile->getClientOriginalName();
                $uploadedFile->move(public_path("finac/license"), $filename);
                $new_armory->license = $filename;
            }
            $new_armory->id_country = 37; //specifions directement qu'il s'agit du cameroun
            $new_armory->id_states = $id_state;
            $new_armory->id_town = $id_town;
            $new_armory->id_user = Auth::user()->id;
            $new_armory->name = $name;
            $new_armory->sector = $sector;
            $new_armory->address = $address;
            $new_armory->email = $email;
            $new_armory->mailbox = $mailbox;
            $new_armory->phone_number = $phone_number;
            $new_armory->agrement_number = $agrement;
            $new_armory->save();
            var_dump('success');
            return redirect()->back();

        }catch (\Exception $e) {
            var_dump($e);
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


    public function storeWeaponSale(Request $request)
    {
        try {

            $weapon_type = $request->weapon_type;
            $serial_number = $request->serial_number;
            $profession = $request->profession;
            $email = $request->email;
            $age = $request->age;
            $identity_number = $request->identity_number;
            $NUI = $request->NUI;
            $id_user = Auth::user()->id;
            $origin_proof = $request->origin_proof;


            if (empty($weapon_type) || empty($serial_number) || empty($email)   || empty($profession) || empty($age) || empty($identity_number) || empty($NUI) || empty($origin_proof)) {
                var_dump('Veuillez remplir tous les champs');
                return redirect()->back();
            }

            $holder_weapon = new HolderWeapon();
            if ($request->hasFile('holder_weapons_picture')) {
                $uploadedFile = $request->file('holder_weapons_picture');
                $filename = time() . $uploadedFile->getClientOriginalName();
                $uploadedFile->move(public_path("finac/holder_weapons_picture"), $filename);
                $holder_weapon->photo = $filename;
            }

            $holder_weapon = new HolderWeapon();
            $holder_weapon->email = $email;
            $holder_weapon->profession = $profession;
            $holder_weapon->age = $age;
            $holder_weapon->identity_number = $identity_number;
            $holder_weapon->NUI = $NUI;
            $holder_weapon->origin_proof = $origin_proof;
            $holder_weapon->id_user = $id_user;
            $holder_weapon->save();

            $holder_id = User::checkUser($email);
            $new_weapon = new Weapon();
            $new_weapon->weapon_type = $weapon_type;
            $new_weapon->serial_number = $serial_number;
            $new_weapon->holder_id = $holder_id; // Relier l'arme au détenteur (acheteur)
            $new_weapon->save();

            $port_request = new PermissionsPort();
            $port_request->buyer_id = $holder_id;
            $port_request->code_FINAC = null; //demande pas encore approuvee
            $port_request->issue_date = now();
            $port_request->save();



            var_dump('Vente d\'arme enregistrée avec succès');
        return redirect()->back();
    } catch (\Exception $e) {
        var_dump($e);
        return redirect()->back();
    }
}

}
