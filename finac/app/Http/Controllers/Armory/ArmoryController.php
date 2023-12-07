<?php

namespace App\Http\Controllers\Armory;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\MailController;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\armory\Armory;
use App\Models\armory\HoldersWeapon;
use App\Models\internaltionalison\State;
use App\Models\internaltionalison\District;
use App\Models\PermissionsPort;
use App\Models\user\User;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Nonstandard\Uuid;

class ArmoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $armoryId = $user->getArmoryId();
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->get();
        $weaponTypesId = WeaponType::where('armory_id', $armoryId)->pluck('id');
        $weapons = Weapon::whereIn('weapon_type_id', $weaponTypesId)->pluck('id');
        $permissionsPorts = PermissionsPort::whereIn('weapon_id', $weapons)->get();
        $states = State::all();


        return view('armory.index', compact('states', 'weaponTypes', 'armoryId' , 'permissionsPorts'));
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
            $armory_id = Uuid::uuid4()->toString();

            $name = $request->name;
            $sector = $request->sector;
            $address = $request->address;
            $email = $request->email;
            $mailbox = $request->mailbox;
            $phone_number = $request->phone_number;
            $agrement = $request->agrement_number;
            $departement_id = $request->departement_id;

            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $sector, $address, $email, $mailbox, $phone_number, $agrement, $departement_id])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $existingArmory = Armory::where('email', $email)->first();
            if ($existingArmory) {
                throw new \Exception('Cet email est déjà associé à une armurerie.');
            }

            $new_armory = new Armory();
            if ($request->hasFile('license')) {
                $filename = HelpersFunction::handleFileUpload($request->file('license'), 'public/finac/licence/');
                $new_armory->license = $filename;
            }


            $new_armory->id = $armory_id;
            $new_armory->country_id = '37'; //specifions directement qu'il s'agit du cameroun
            $new_armory->departement_id = $departement_id;
            $new_armory->name = $name;
            $new_armory->sector = $sector;
            $new_armory->address = $address;
            $new_armory->email = $email;
            $new_armory->mailbox = $mailbox;
            $new_armory->phone_number = $phone_number;
            $new_armory->agrement_number = $agrement;
            $new_armory->save();

           $new_user = $this->createUser($new_armory , $armory_id);
           $new_user->save();
            toastr()->success('Armureries enregistree avec success');
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Affichage des toasts en cas d'erreur
            dd($e);
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    private function createUser($armory , $armoryID)
    {
        $generatedPwd = HelpersFunction::generateStrongPassword();
        $generatedLogin = HelpersFunction::generateUniqueLogin($armory->email);
        $user_id = Uuid::uuid4();


        $new_user = new User();
        $new_user->id = $user_id;
        $new_user->generated_login  = $generatedLogin;
        $new_user->generated_password = $generatedPwd;
        $new_user->prefix = 'armory';
        $new_user->ressource_id = $armoryID;

//        HelpersFunction::sendEmail($generatedLogin, $generatedPwd , $armory->email);
        return $new_user;
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::where('ressource_id', $id)->first();
            $check = Armory::where('id', $id)->first();

            if ($user && $check) {
                $mergedData = array_merge($user->toArray(), $check->toArray());
                return response()->json($mergedData);
            } else {
                return response()->json('off');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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
    public function update(Request $request, $id)
    {
        try {
            $name = $request->edit_name;
            $sector = $request->edit_sector;
            $address = $request->edit_address;
            $email = $request->edit_email;
            $mailbox = $request->edit_mailbox;
            $phone_number = $request->edit_phone_number;
            $departement_id = $request->edit_departement_id;

            // Vérifier si toutes les données nécessaires sont remplies
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $sector, $address, $email, $mailbox, $phone_number, $departement_id])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $armory = Armory::findOrFail($id);

            $armory->departement_id = $departement_id;
            $armory->name = $name;
            $armory->sector = $sector;
            $armory->address = $address;
            $armory->email = $email;
            $armory->mailbox = $mailbox;
            $armory->phone_number = $phone_number;
            $armory->save();

            $user = User::where('ressource_id', $id)->first();

            // Mettre à jour les informations de connexion
            $user->generated_login = $request->login;
            $user->generated_password = $request->pwd;
            $user->save();

            toastr()->success('Armurerie mise à jour avec succès');
            return redirect()->route('weapons_type.index');
        } catch (\Exception $e) {
            // En cas d'erreur, affichage de messages et redirection
            toastr()->error($e->getMessage());
            dd($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $check = Armory::where('id', $id);
            if ($check) {
                if ($check->delete()) {
                    return response()->json($check);
                } else {
                    return response()->json($check);
                }
            } else {
                return response()->json($check);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function addFicheArm(Request $request)
    {

        try {
            $uuid = Uuid::uuid4();
            $permissionPortUid = Uuid::uuid4();
            $weaponUid = Uuid::uuid4();

            // Holders Data
            $fullname = $request->fullname;
            $telephone = $request->telephone;
            $email = $request->email;
            $profession = $request->profession;

            $weapon_type = $request->weapon_type;
            $serial_number = $request->serial_number;

            if (empty($fullname) || empty($telephone) ||
                empty($weapon_type) || empty($serial_number) || empty($email) ||
                empty($profession)) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $serialNumberExists = Weapon::where('serial_number', $serial_number)->exists();
            if ($serialNumberExists) {
                throw new \Exception('Le numéro de série de l\'arme existe déjà.');
            }

            $holder_weapon = new HoldersWeapon();
            $uploadedFilesCount = 0;

            if ($request->hasFile('holder_weapons_picture')) {
                $filename = HelpersFunction::handleFileUpload($request->file('holder_weapons_picture'), 'public/finac/holder_weapons_picture/');
                $holder_weapon->photo = $filename;
                $uploadedFilesCount++;                }

             if ($request->hasFile('identity_number')) {
                $filename = HelpersFunction::handleFileUpload($request->file('identity_number'), 'public/finac/identity_number/');
                 $holder_weapon->identity_number = $filename;
                 $uploadedFilesCount++;            }

             if ($request->hasFile('buy_permission')) {
                $filename = HelpersFunction::handleFileUpload($request->file('buy_permission'), 'public/finac/buy_permission/');
                 $holder_weapon->buy_permission = $filename;
                 $uploadedFilesCount++;                }

             if ($request->hasFile('moral_certificate')) {
                $filename = HelpersFunction::handleFileUpload($request->file('moral_certificate'), 'public/finac/moral_certificate/');
                 $holder_weapon->buy_permission = $filename;
                 $uploadedFilesCount++;                }

            $totalExpectedFiles = 4; // Nombre total de fichiers attendus

            if ($uploadedFilesCount !== $totalExpectedFiles) {
                throw new \Exception('Veuillez télécharger tous les fichiers requis.');
            }

            $holder_weapon->id = $uuid->toString();
            $holder_weapon->fullname = $fullname;
            $holder_weapon->telephone = $telephone;
            $holder_weapon->email = $email;
            $holder_weapon->profession = $profession;


            $new_weapon = new Weapon();
            $new_weapon->id = $weaponUid->toString();
            $new_weapon->weapon_type_id = $weapon_type;
            $new_weapon->serial_number = $serial_number;
            $holder_weapon->save();
            $new_weapon->holder_id = $uuid->toString(); // Relier l'arme au détenteur (acheteur)
            $new_weapon->save();

            $port_request = new PermissionsPort();
            $port_request->id =$permissionPortUid->toString();
            $port_request->holder_id = $uuid->toString();
            $port_request->weapon_id = $weaponUid->toString();
            $port_request->date_demande = now();
            $port_request->save();

            toastr()->success('Fiche d\'arme ajouter');
            return redirect()->route('armory.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            // En cas d'erreur, affichage de messages et redirection
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
}

    public function gotoAddWeaponsSheet()
    {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $armoryId = $user->getArmoryId();
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->get();
        return view('armory.add_weapons_sheet.add_weapons_sheet' , compact('weaponTypes'));

}

}
