<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\armory\Armory;
use App\Models\internaltionalison\State;
use App\Models\PermissionsPort;
use App\Models\user\subAdmin\Governor;
use App\Models\user\subAdmin\Minatd;
use App\Models\weapons\Ammunition;
use App\Models\weapons\Weapon;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::all();
        $allMinatdUsers = Minatd::whereIsDelete(false)->get();
        $allGovernorServices = Governor::whereIsDelete(false)->get();
        $armories = Armory::all();

        return view('system.index', compact('allMinatdUsers', 'states', 'allGovernorServices', 'armories'));
    }

    public function getAllGovernorsServices()
    {

        $states = State::all();

        $allGovernorServices = Governor::whereIsDelete(false)->get();
        return view('system.governor.index', compact('allGovernorServices', 'states'));
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
        //
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

    public function getArmorySytemdetails($armoryId)
    {
        $weaponTypes = WeaponType::where('armory_id', $armoryId)->get();
        $ammos = Ammunition::whereIsDelete(false)->where('armory_id', $armoryId)->get();
        $weaponTypesId = WeaponType::where('armory_id', $armoryId)->pluck('id');

        $weapons = Weapon::whereIn('weapon_type_id', $weaponTypesId)->pluck('id');

        $permissionsPorts = PermissionsPort::whereIn('weapon_id', $weapons)->get();

        return view('system.armory.index', compact('weaponTypes', 'ammos', 'permissionsPorts', 'armoryId'));

    }
}