<?php

namespace App\Http\Controllers\Declaration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\declaration\Declaration;
use Illuminate\Http\Request;

class DeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $declaration = Declaration::all();
        return view('declaration.LossDeclaration');
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
            $finac_code = $request->finac_code;
            $series_number = $request->series_number;
            $name = $request->name;
            $surname = $request->surname;
            $dateNaissance = $request->dateNaissance;
            $lieuNaissance = $request->lieuNaissance;
            $photoRecto = $request->photoRecto;
            $photoVerso = $request->photoVerso;
            $date = $request->date;
            $adresse = $request->adresse;
            $description = $request->description;

            // Vérifier si tous les champs nécessaires sont remplis
            if (HelpersFunction::checkValueOfArrayIsEmpty([$finac_code, $series_number, $date, $adresse, $description])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            // Créer une nouvelle déclaration
            $new_declaration = new Declaration();
            $new_declaration->id = \Illuminate\Support\Str::uuid(); // Génération d'UUID
            $new_declaration->finac_code = $finac_code;
            $new_declaration->series_number = $series_number;
            $new_declaration->name = $request->name;
            $new_declaration->surname = $request->surname;
            $new_declaration->dateNaissance = $request->dateNaissance;
            $new_declaration->lieuNaissance = $request->lieuNaissance;
            $new_declaration->photoRecto = $request->photoRecto;
            $new_declaration->photoVerso = $request->photoVerso;
            $new_declaration->date = $date;
            $new_declaration->adresse = $adresse;
            $new_declaration->description = $description;


            // Gérez le téléchargement des photos si elles sont présentes
            if ($request->hasFile('photoRecto')) {
                $photoRecto = $request->file('photoRecto');
                $photoRectoName = time() . '_recto.' . $photoRecto->getClientOriginalExtension();
                $photoRecto->move(public_path('photos'), $photoRectoName);
                $new_declaration->photoRecto = $photoRectoName;
            }

            if ($request->hasFile('photoVerso')) {
                $photoVerso = $request->file('photoVerso');
                $photoVersoName = time() . '_verso.' . $photoVerso->getClientOriginalExtension();
                $photoVerso->move(public_path('photos'), $photoVersoName);
                $new_declaration->photoVerso = $photoVersoName;
            }


            $new_declaration->save();

            toastr()->success('Déclaration enregistrée avec succès');
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Affichage des toasts en cas d'erreur
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
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

}
