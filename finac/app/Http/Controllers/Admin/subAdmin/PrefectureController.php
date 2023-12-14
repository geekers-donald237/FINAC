<?php

namespace App\Http\Controllers\Admin\subAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\armory\Armory;
use App\Models\armory\HoldersWeapon;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\State;
use App\Models\internaltionalison\District;
use App\Models\PermissionsPort;
use App\Models\user\subAdmin\Governor;
use App\Models\user\subAdmin\Prefect;
use App\Models\user\User;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Ramsey\Uuid\Nonstandard\Uuid;

class PrefectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prefecture_id = auth()->user()->ressource_id;
        $prefecture = Prefect::find($prefecture_id);
        $permissionsPorts = PermissionsPort::all();
        $departement_id = $prefecture->departement_id;

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
                if ($weapons->weaponType->armory->departement_id == $departement_id) {
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

        return view('prefecture.index', compact(
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
            $departement_id = $request->departement_id;

            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $email, $mailbox, $phone_number, $departement_id])) {
                throw new \Exception('Veuillez remplir tous les champs.');
            }

            $existingMinatd = Prefect::where('email', $email)->first();
            if ($existingMinatd) {
                throw new \Exception('Cet email est déjà associé à un service Minatd existant.');
            }

            $newPrefecture = new Prefect();

            $newPrefecture->id = $uuid->toString();
            $newPrefecture->country_id = '1'; // Spécifiez directement qu'il s'agit du Cameroun
            $newPrefecture->departement_id = $departement_id;
            $newPrefecture->name = $name;
            $newPrefecture->email = $email;
            $newPrefecture->mailbox = $mailbox;
            $newPrefecture->phone_number = $phone_number;

            // Sauvegardez le service Minatd
            $newPrefecture->save();
            $login = HelpersFunction::generateUniqueLogin($email);
            $password = HelpersFunction::generateStrongPassword();

            // Créez une nouvelle instance d'utilisateur associée au service Minatd
            $newUser = new User();
            $newUser->id = $uuidUser->toString();
            $newUser->generated_login = $login;
            $newUser->generated_password = $password;
            $newUser->prefix = 'prefecture';
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

    public function index2()
    {
        $towns = District::all();
        $states = State::all();
        $prefecture_id = auth()->user()->ressource_id;
        $prefecture = Prefect::find($prefecture_id);

        // Récupérez les armureries dont l'ID de département est autorisé
        $armories = Armory::where('is_delete', false)
            ->where('departement_id', $prefecture->departement_id)
            ->get();

        return view('prefecture.armory.index', compact( 'towns', 'states', 'armories'));
    }



    public function gotoHolderWeaponsDetails($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('prefecture.details.holder_weapons_details', compact('holderWeapons', 'weapon'  , 'id'));
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function gotoLostArm()
    {
        try {
            return view('prefecture.weapon_lost.index');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getArmoryPrefectureDetails($armoryId)
    {
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->get();
        $weaponTypesId = WeaponType::where('armory_id', $armoryId)->pluck('id');
        $armory = Armory::find($armoryId);
        $armoryName = $armory->name;


        $weapons = Weapon::whereIn('weapon_type_id', $weaponTypesId)->pluck('id');

        $permissionsPorts = PermissionsPort::whereIn('weapon_id', $weapons)->get();

        return view('prefecture.armory.armory_details',compact('weaponTypes' ,'armoryName','permissionsPorts' , 'armoryId'));

    }

    public function gotoHolderWeaponsDetailsCopy($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('prefecture.details.finac_sheet', compact('holderWeapons', 'permissionsPort','weapon'  , 'id'));
        } catch (\Exception $e) {
            dd($e);
            // Gérer l'exception, par exemple, rediriger ou afficher un message d'erreur
        }
    }


    public function resendEmail($prefecture_id)
    {
        // Obtenez la préfecture par son ID
        $prefecture = Prefect::findOrFail($prefecture_id);

        // Obtenez l'utilisateur associé à la préfecture
        $user = User::where('ressource_id', $prefecture_id)->firstOrFail();

        // Obtenez le login généré et le mot de passe
        $generatedLogin = $user->generated_login;
        $generatedPassword = HelpersFunction::generateRandomCode();

        HelpersFunction::sendEmail($generatedLogin, $generatedPassword, $prefecture->email);
        $user->update(['generated_password' => Hash::make($generatedPassword)]);


        toastr()->success( 'E-mail renvoyé avec succès.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $check = Prefect::where('id', $id)->first();
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
            $departement_id = $request->edit_departement_id;

            // Vérifier si toutes les données nécessaires sont remplies
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $email, $mailbox, $phone_number, $departement_id])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $prefecture = Prefect::findOrFail($id);

            $prefecture->departement_id = $departement_id;
            $prefecture->name = $name;
            $prefecture->email = $email;
            $prefecture->mailbox = $mailbox;
            $prefecture->phone_number = $phone_number;
            // Ajoutez d'autres champs en fonction de vos besoins

            $prefecture->save();

            toastr()->success('Service Prefect mis à jour avec succès');
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
            $prefecture = Prefect::find($id);

            if ($prefecture) {
                $prefecture->is_delete = true;
                $prefecture->save();

                return response()->json(['message' => 'done']);
            } else {
                return response()->json(['error' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
