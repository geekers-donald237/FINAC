<?php

namespace App\Http\Controllers\Admin\subAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\MailController;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\armory\Armory;
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
use Ramsey\Uuid\Nonstandard\Uuid;


class MinatdController extends Controller
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

        return view('minatd.index', compact('permissionsPorts', 'associatedData' , 'permissionsRejetees' ,'permissionsValides' , 'permissionsNonTraitees'));
    }

    public function getAllGovernorsServices()
    {

        $allMinatdUsers = Minatd::where('is_delete' , false)->get();
        $allGovernorServices = Governor::whereIsDelete(false)->get();
        $armories = Armory::all();

        return view('minatd.governor.index' , compact('allMinatdUsers'   , 'allGovernorServices' , 'armories' ));
    }

    public function getAllPrefectures()
    {

        $allPrefectures = Prefect::whereIsDelete(false)->get();

        return view('minatd.prefecture.index' , compact( 'allPrefectures' ));
    }

    public function index2()
    {
        $towns = District::all();
        $states = State::all();
        $allArmories = Armory::where('is_delete' , false)->get();
        $allGovernorServices = Governor::whereIsDelete(false)->get();
        $allPrefectures = Prefect::whereIsDelete(false)->get();
        $armories = Armory::all();

        return view('minatd.armory.index' , compact('allArmories' , 'towns' , 'states' , 'allPrefectures' , 'allGovernorServices' , 'armories' ));

    }


    public function gotoHolderWeaponsDetails($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('minatd.details.holder_weapons_details', compact('holderWeapons', 'weapon'  , 'id'));
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function gotoLostArm()
    {
        try {
            return view('minatd.weapon_lost.index');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function gotoDeclaredArm()
    {
        try {
            return view('minatd.weapon_declared.index');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getArmoryMinatdDetails($armoryId)
    {
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->get();
        $weaponTypesId = WeaponType::where('armory_id', $armoryId)->pluck('id');
        $armory = Armory::find($armoryId);
        $armoryName = $armory->name;


        $weapons = Weapon::whereIn('weapon_type_id', $weaponTypesId)->pluck('id');

        $permissionsPorts = PermissionsPort::whereIn('weapon_id', $weapons)->get();

        return view('minatd.armory.armory_details',compact('weaponTypes' ,'armoryName','permissionsPorts' , 'armoryId'));

    }

    public function gotoHolderWeaponsDetailsCopy($id)
    {
        try {
            $permissionsPort = PermissionsPort::findOrFail($id);
            $holderWeapons = $permissionsPort->holderWeapons;
            $weapon = $permissionsPort->weapon;

            return view('minatd.details.finac_sheet', compact('holderWeapons', 'permissionsPort','weapon'  , 'id'));
        } catch (\Exception $e) {
            dd($e);
            // Gérer l'exception, par exemple, rediriger ou afficher un message d'erreur
        }
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

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

}
