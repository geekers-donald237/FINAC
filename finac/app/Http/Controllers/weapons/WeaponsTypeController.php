<?php

namespace App\Http\Controllers\weapons;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\State;
use App\Models\internaltionalison\District;
use App\Models\user\User;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class WeaponsTypeController extends Controller
{
    public function index() {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $armoryId = $user->getArmoryId();
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->whereIsDelete(false)->get();
        return view('armory.stock_details.all_weapons_type' , compact('armoryId' , 'weaponTypes' ));
    }

    public function create() {
//        return view('weapon_types.create');
    }

    public function store(Request $request)
    {
        try {


            $types = $request->input('type');
            $armory_id = $request->input('armory_id');
            $quantities = $request->input('quantity');
            $descriptions = $request->input('description');

            if (HelpersFunction::checkValueOfArrayIsEmpty([$types, $quantities , $descriptions])) {
                throw new \Exception('Veuillez remplir au moins les champs pour la première arme.');
            }

            // Vérifiez si le premier ensemble de champs est rempli
            if (HelpersFunction::checkValueOfArrayIsEmpty([$types[0], $quantities[0] , $descriptions[0]])) {
                throw new \Exception('Veuillez remplir tous les champs pour la première arme.');
            }

            // Itérer sur les stocks reçus pour les enregistrer
            foreach ($types as $key => $type) {
                $quantity = $quantities[$key];
                $description = $descriptions[$key];

                // Vérifiez si les champs sont vides pour les autres ensembles
                if ($key > 0 && (HelpersFunction::checkValueOfArrayIsEmpty([$type , $quantity , $description]))) {
                    continue; // Passe à l'itération suivante sans générer d'erreur
                }

                // Vérifiez si le type d'arme existe déjà
                $existingType = WeaponType::where('type', $type)->where('armory_id', $armory_id)->first();

                // Si le type existe déjà, affichez un toast et continuez à l'itération suivante
                if ($existingType) {
                    toastr()->error("L'élément avec le nom '$type' existe déjà.");
                    continue;
                }

                WeaponType::create([
                    'id'=>   Uuid::uuid4()->toString(),
                    'type' => $type,
                    'armory_id' => $armory_id,
                    'quantity' => $quantity,
                    'description' => $description,
                ]);
                toastr()->success('les Types inexistant on ete emregirtres deja.');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show(string $id)
    {
        try {
            $weapon = WeaponType::getSingle($id);
            return  response()->json($weapon);
        } catch (\Exception $e) {
            return response()->json('off');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $save = WeaponType::getSingle($id);
            if ($save) {
                $save->delete();
                return response()->json('ok');
            } else {
                return response()->json('off');
            }
        } catch (\Exception $e) {
            return response()->json('off');
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request) {
        try {
            $id_weapon = $request->input('id_weapon');
            $type = $request->input('type');
            $quantity = $request->input('quantity');
            $description = $request->input('description');

            if (HelpersFunction::checkValueOfArrayIsEmpty([$type, $quantity, $description])) {
                throw new \Exception('Veuillez remplir tous les champs.');
            }

            $existingType = WeaponType::where('type', $type)->where('id', '!=', $id_weapon)->first();
            if ($existingType) {
                throw new \Exception('Ce type d\'arme existe déjà.');
            }

            $weaponType = WeaponType::findOrFail($id_weapon);
            $weaponType->type = $type;
            $weaponType->quantity = $quantity;
            $weaponType->description = $description;
            $weaponType->save();

            toastr()->success('Modifications enregistrées avec succès');
            return redirect()->back();
        } catch (\Exception $e) {
            // Affichage des toasts en cas d'erreur
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $save = WeaponType::find($id);
            if ($save) {
                $save->is_delete = true;
                $save->save();
                return response()->json('ok');
            } else {
                return response()->json('off');
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }





    public function gotoProfileScreen()
    {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $armoryId = $user->getArmoryId();
        $departements = Departement::all();
        $districts = District::all();
        return view('armory.edit.edit_armory' , compact('districts' ,'departements' , 'armoryId'));
    }
}
