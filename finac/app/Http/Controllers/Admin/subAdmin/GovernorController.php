<?php

namespace App\Http\Controllers\Admin\subAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\MailController;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\armory\Armory;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\State;
use App\Models\internaltionalison\District;
use App\Models\PermissionsPort;
use App\Models\user\subAdmin\Governor;
use App\Models\user\subAdmin\Minatd;
use App\Models\user\subAdmin\Prefect;
use App\Models\user\User;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Nonstandard\Uuid;

class GovernorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $permissionsPorts = PermissionsPort::all();
        $permissionsValides = PermissionsPort::where('code_finac', '!=', null)->count();
        $permissionsRejetees = PermissionsPort::where('statut', 'rejete')->count();
        $permissionsNonTraitees = PermissionsPort::whereNull('code_finac')->count() - ($permissionsValides + $permissionsRejetees);


        $associatedData = [];

        foreach ($permissionsPorts as $permissionsPort) {
            $associatedData[$permissionsPort->id]['permissionsPortId'] = $permissionsPort->id;
            $associatedData[$permissionsPort->id]['holderWeapons'] = $permissionsPort->holderWeapons;
            $associatedData[$permissionsPort->id]['weapon'] = $permissionsPort->weapon;
        }

        return view('governor.index' , compact('permissionsPorts', 'associatedData' , 'permissionsRejetees' ,'permissionsValides' , 'permissionsNonTraitees') );
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
        $uuid = Uuid::uuid4();
        $uuidUser = Uuid::uuid4();

        try {
            $name = $request->name;
            $email = $request->email;
            $mailbox = $request->mailbox;
            $phone_number = $request->phone_number;
            $state_id = $request->state_id;

            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $email, $mailbox, $phone_number, $state_id])) {
                throw new \Exception('Veuillez remplir tous les champs.');
            }

            $existingMinatd = Governor::where('email', $email)->first();
            if ($existingMinatd) {
                throw new \Exception('Cet email est déjà associé à un service Minatd existant.');
            }

            $newGovernor = new Governor();

            $newGovernor->id = $uuid->toString();
            $newGovernor->country_id = '37'; // Spécifiez directement qu'il s'agit du Cameroun
            $newGovernor->state_id = $state_id;
            $newGovernor->name = $name;
            $newGovernor->email = $email;
            $newGovernor->mailbox = $mailbox;
            $newGovernor->phone_number = $phone_number;

            // Sauvegardez le service Minatd
            $newGovernor->save();
            $login = HelpersFunction::generateUniqueLogin($email);
            $password = HelpersFunction::generateStrongPassword();

            // Créez une nouvelle instance d'utilisateur associée au service Minatd
            $newUser = new User();
            $newUser->id = $uuidUser->toString();
            $newUser->generated_login = $login;
            $newUser->generated_password = $password;
            $newUser->prefix = 'governor';
            $newUser->ressource_id = $uuid->toString();

            // Sauvegardez l'utilisateur
            $newUser->save();
            HelpersFunction::sendEmail($login, $password , $newUser->email);

            toastr()->success('Service Minatd enregistré avec succès.');
            return redirect()->back();
        } catch (\Exception $e) {
            // Affichage des toasts en cas d'erreur
            dd($e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function resendEmail($governor_id)
    {
        // Obtenez la préfecture par son ID
        $governorGovernorat = Governor::findOrFail($governor_id);

        // Obtenez l'utilisateur associé à la préfecture
        $user = User::where('ressource_id', $governor_id)->firstOrFail();

        // Obtenez le login généré et le mot de passe
        $generatedLogin = $user->generated_login;
        $generatedPassword = HelpersFunction::generateRandomCode();

        HelpersFunction::sendEmail($generatedLogin, $generatedPassword, $user->email);
        $user->update(['generated_password' => Hash::make($generatedPassword)]);

        toastr()->success( 'E-mail renvoyé avec succès.');
        return redirect()->back();
    }

    public function index2()
    {
        $towns = District::all();
        $states = State::all();
        $allArmories = Armory::where('is_delete' , false)->get();
        $armories = Armory::all();

        return view('governor.armory.index' , compact('allArmories' , 'towns' , 'states'  , 'armories' ));

    }


    public function gotoHolderWeaponsDetails($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('governor.details.holder_weapons_details', compact('holderWeapons', 'weapon'  , 'id'));
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function gotoLostArm()
    {
        try {
            return view('governor.weapon_lost.index');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getArmoryGovernorDetails($armoryId)
    {
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->get();
        $weaponTypesId = WeaponType::where('armory_id', $armoryId)->pluck('id');
        $armory = Armory::find($armoryId);
        $armoryName = $armory->name;


        $weapons = Weapon::whereIn('weapon_type_id', $weaponTypesId)->pluck('id');

        $permissionsPorts = PermissionsPort::whereIn('weapon_id', $weapons)->get();

        return view('governor.armory.armory_details',compact('weaponTypes' ,'armoryName','permissionsPorts' , 'armoryId'));

    }

    public function gotoHolderWeaponsDetailsCopy($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('governor.details.finac_sheet', compact('holderWeapons', 'permissionsPort','weapon'  , 'id'));
        } catch (\Exception $e) {
            dd($e);
            // Gérer l'exception, par exemple, rediriger ou afficher un message d'erreur
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $check = Governor::where('id', $id)->first();
            if ($check) {
                return response()->json($check);
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
            $email = $request->edit_email;
            $mailbox = $request->edit_mailbox;
            $phone_number = $request->edit_phone_number;
            $state_id = $request->edit_state_id;

            // Vérifier si toutes les données nécessaires sont remplies
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $email, $mailbox, $phone_number,$state_id])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $governor = Governor::findOrFail($id);

            $governor->state_id = $state_id;
            $governor->name = $name;
            $governor->email = $email;
            $governor->mailbox = $mailbox;
            $governor->phone_number = $phone_number;
            // Ajoutez d'autres champs en fonction de vos besoins

            $governor->save();

            toastr()->success('Service Gouverneur mis à jour avec succès');
            return redirect()->back();
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
            $governor = Governor::find($id);

            if ($governor) {
                $governor->is_delete = true;
                $governor->save();

                return response()->json(['message' => 'done']);
            } else {
                return response()->json(['error' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
