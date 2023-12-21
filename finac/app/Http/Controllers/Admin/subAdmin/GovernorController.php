<?php

namespace App\Http\Controllers\Admin\subAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\armory\Armory;
use App\Models\armory\HoldersWeapon;
use App\Models\internaltionalison\State;
use App\Models\PermissionsPort;
use App\Models\user\subAdmin\Governor;
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
        $governor_id = auth()->user()->ressource_id;
        $governor = Governor::find($governor_id);
        $permissionsPorts = PermissionsPort::all();
        $state_id = $governor->state_id;

        $permissionsAvecArmureries = [];
        $permissionsTraitees = 0;
        $permissionsNonTraitees = 0;
        $permissionsRejetees = 0;

        // Boucler à travers chaque enregistrement de PermissionsPort
        foreach ($permissionsPorts as $permissionsPort) {
            // Récupérer l'ID de l'arme depuis l'enregistrement de PermissionsPort
            $weaponsId = $permissionsPort->weapon_id;

            // Créer un objet Weapons à partir de l'ID de l'arme
            $weapons = Weapon::find($weaponsId);

            // Vérifier si l'objet Weapons a été trouvé
            if ($weapons) {
                // Vérifier si le département de l'armurerie est le même que celui de la préfecture
                if ($weapons->weaponType->armory->state_id == $state_id) {
                    // Utiliser la relation pour obtenir l'armurerie associée
                    $armory = $weapons->weaponType->armory;

                    // Ajouter les données nécessaires au tableau des résultats finaux
                    $holderId = $weapons->holder_id;
                    $holder = HoldersWeapon::find($holderId);

                    $permissionsAvecArmureries[] = [
                        'permissionsPort' => $permissionsPort,
                        'weapons' => $weapons,
                        'armory' => $armory,
                        'holder' => $holder,
                    ];

                    // Mettre à jour les compteurs
                    switch ($permissionsPort->statut) {
                        case 'valide':
                            $permissionsTraitees++;
                            break;
                        case 'rejete':
                            $permissionsRejetees++;
                            break;
                        default:
                            $permissionsNonTraitees++;
                            break;
                    }
                }
            }
        }

        return view('governor.index', compact(
            'permissionsPorts',
            'permissionsAvecArmureries',
            'permissionsTraitees',
            'permissionsRejetees',
            'permissionsNonTraitees'
        ));
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
            $newGovernor->country_id = '1'; // Spécifiez directement qu'il s'agit du Cameroun
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
            HelpersFunction::sendEmail($login, $password, $newUser->email);

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

        toastr()->success('E-mail renvoyé avec succès.');
        return redirect()->back();
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
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $email, $mailbox, $phone_number, $state_id])) {
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

    public function index2()
    {
        $states = State::all();
        $gouverneur_id = auth()->user()->ressource_id;
        $gouverneur = Governor::find($gouverneur_id);
        $state_id = $gouverneur->state_id;


        // Récupérez les armureries dont l'ID de département est autorisé
        $armories = Armory::where('is_delete', false)
            ->where('state_id', $state_id)
            ->get();


        return view('governor.armory.index', compact('armories', 'states'));
    }

    public function gotoHolderWeaponsDetails($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('governor.details.holder_weapons_details', compact('holderWeapons', 'weapon', 'id'));
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

        return view('governor.armory.armory_details', compact('weaponTypes', 'armoryName', 'permissionsPorts', 'armoryId'));

    }

    public function gotoHolderWeaponsDetailsCopy($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('governor.details.finac_sheet', compact('holderWeapons', 'permissionsPort', 'weapon', 'id'));
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
