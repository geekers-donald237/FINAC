<?php

namespace App\Http\Controllers\weapons;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\District;
use App\Models\user\User;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WeaponsTypeController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $armoryId = $user->getArmoryId();
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->whereIsDelete(false)->get();
        return view('armory.stock_details.all_weapons_type', compact('armoryId', 'weaponTypes'));
    }

    public function index2()
    {
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $armoryId = $user->getArmoryId();
        return view('armory.stock_details.add_stock', compact('armoryId'));
    }

    public function create()
    {
//        return view('weapon_types.create');
    }

    public function store(Request $request)
    {
        try {
            $type = $request->input('type');
            $armory_id = $request->input('armory_id');
            $quantity = $request->input('quantity');
            $description = $request->input('description');
            $serialNumbers = $request->input('serialnumber');

            if (HelpersFunction::checkValueOfArrayIsEmpty([$type, $quantity, $description, $serialNumbers])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $uid = Str::uuid()->toString();

            // Create the WeaponType
            $weaponType = WeaponType::create([
                'id' => $uid,
                'type' => $type,
                'armory_id' => $armory_id,
                'quantity' => $quantity,
                'description' => $description,
            ]);

            if (empty($serialNumbers)) {
                throw new \Exception('Veuillez renseigner les numero de serie');
            }

            // Validate uniqueness of serial numbers
            $uniqueSerialNumbers = array_unique($serialNumbers);
            if (count($serialNumbers) !== count($uniqueSerialNumbers)) {
                throw new \Exception('Les numéros de série doivent être uniques.');
            }

            $existingSerialNumbers = Weapon::whereIn('serial_number', $uniqueSerialNumbers)->pluck('serial_number')->toArray();
            $duplicateSerialNumbers = array_intersect($uniqueSerialNumbers, $existingSerialNumbers);

            if (!empty($duplicateSerialNumbers)) {
                throw new \Exception('Certains numéros de série existent déjà en base de données.');
            }

            foreach ($serialNumbers as $serialNumber) {
                Weapon::create([
                    'id' => Str::uuid()->toString(),
                    'weapon_type_id' => $uid,
                    'serial_number' => $serialNumber,
                ]);
            }

            toastr()->success('Type d\'armes ajouté');
            return redirect()->route('weapons_type.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show(string $id)
    {
        try {
            $weapon = WeaponType::getSingle($id);
            return response()->json($weapon);
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

    public function update(Request $request)
    {
        try {
            $id_weapon = $request->input('id_weapon');
            $type = $request->input('type');
            $description = $request->input('description');

            if (HelpersFunction::checkValueOfArrayIsEmpty([$type, $description])) {
                throw new \Exception('Veuillez remplir tous les champs.');
            }

            $existingType = WeaponType::where('type', $type)->where('id', '!=', $id_weapon)->first();
            if ($existingType) {
                throw new \Exception('Ce type d\'arme existe déjà.');
            }

            $weaponType = WeaponType::findOrFail($id_weapon);
            $weaponType->type = $type;
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
        return view('armory.edit.edit_armory', compact('districts', 'departements', 'armoryId'));
    }
}
