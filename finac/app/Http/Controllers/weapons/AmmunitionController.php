<?php

namespace App\Http\Controllers\weapons;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\weapons\Ammunition;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AmmunitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ammunitions = Ammunition::whereIsDelete('false')->get();
        return view('armory.ammunition.index', compact('ammunitions'));
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
    public function store(Request $request): RedirectResponse
    {
        try {
            $name = $request->input('name');
            $type = $request->input('type');
            $caliber = $request->input('caliber');
            $quantity_in_stock = $request->input('quantity_in_stock');

            // Vérifier si les champs requis sont remplis
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $type, $caliber, $quantity_in_stock])) {
                throw new Exception('Veuillez remplir tous les champs.');
            }

            // Créer une nouvelle munition
            $ammo = new Ammunition();
            $ammo->name = $name;
            $ammo->type = $type;
            $ammo->caliber = $caliber;
            $ammo->quantity_in_stock = $quantity_in_stock;
            $ammo->save();

            toastr()->success('Stock de munitions ajouté avec succès.');
            return redirect()->route('ammunition.index');
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $check = Ammunition::where('id', $id)->first();
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
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $name = $request->edit_name;
            $type = $request->edit_type;
            $caliber = $request->edit_caliber;
            $quantity_in_stock = $request->edit_quantity_in_stock;

            // Vérifier si toutes les données nécessaires sont remplies
            if (HelpersFunction::checkValueOfArrayIsEmpty([$name, $type, $caliber, $quantity_in_stock])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            // Trouver l'objet Ammo à mettre à jour
            $ammo = Ammunition::findOrFail($id);

            // Vérifier si la quantité diminue
            if ($quantity_in_stock < $ammo->quantity_in_stock) {
                throw new \Exception('On ne peut pas diminuer la quantité de munitions.');
            }

            // Mettre à jour les champs
            $ammo->name = $name;
            $ammo->type = $type;
            $ammo->caliber = $caliber;
            $ammo->quantity_in_stock = $quantity_in_stock;

            // Ajouter d'autres champs en fonction de vos besoins

            // Sauvegarder les modifications
            $ammo->save();

            toastr()->success('Munitions mises à jour avec succès');
            return redirect()->back();
        } catch (\Exception $e) {
            // En cas d'erreur, affichage de messages et redirection
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $ammo = Ammunition::find($id);

            if ($ammo) {
                $ammo->is_delete = true;
                $ammo->save();

                return response()->json(['message' => 'done']);
            } else {
                return response()->json(['error' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    /**
     * @throws Exception
     */
    public function saleAmmunitions(Request $request)
    {


        try {

            $ammunitionId = $request->input('selectAmmo');
            $quantityToSell = $request->input('quantity');
            if (HelpersFunction::checkValueOfArrayIsEmpty([$ammunitionId, $quantityToSell])) {
                throw new \Exception('Veuillez remplir tous les champs');

            }
            $ammunition = Ammunition::find($ammunitionId);

            if (!$ammunition) {
                throw new \Exception('Munition introuvable');
            }

            // Vérifiez si la quantité disponible est suffisante
            if ($quantityToSell > $ammunition->quantity_in_stock) {
                throw new \Exception('Quantité insuffisante en stock');
            }

            $ammunition->quantity_in_stock -= $quantityToSell;
            $ammunition->save();

            toastr()->success('Munitions mises à jour avec succès');
            return redirect()->back();
        } catch (\Exception $e) {
            // En cas d'erreur, affichage de messages et redirection
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

}
