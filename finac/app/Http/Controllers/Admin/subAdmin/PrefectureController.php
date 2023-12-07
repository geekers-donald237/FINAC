<?php

namespace App\Http\Controllers\Admin\subAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\State;
use App\Models\internaltionalison\District;
use App\Models\user\subAdmin\Governor;
use App\Models\user\subAdmin\Prefect;
use App\Models\user\User;
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
        $departements = Departement::orderBy('name', 'asc')->get();
        $allPrefectures = Prefect::whereIsDelete(false)->get();
        return view('prefecture.index' , compact( 'departements' ,'allPrefectures' ));

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
            $newPrefecture->country_id = '37'; // Spécifiez directement qu'il s'agit du Cameroun
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
