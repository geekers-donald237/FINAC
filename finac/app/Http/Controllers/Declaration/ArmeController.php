<?php

namespace App\Http\Controllers\Declaration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\declaration\DeclarationArme;
use Illuminate\Http\Request;

class ArmeController extends Controller
{

    public function index()
    {
        $declarationarmes = DeclarationArme::all();
        return view('declaration.WeaponsDeclaration', compact('declarationarmes'));
    }

    /**
     * Affiche le formulaire de création d'une arme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('declarationarmes.create');
    }

    /**
     * Stocke une nouvelle arme dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $noms = $request->noms;
            $prenom = $request-> prenom;
            $adresse = $request->adresse;
            $date = $request->date;
            $circonstance = $request->circonstance;
            $numero_serie = $request->numero_serie;
            $marque = $request->marque;
            $photo= $request->photo;
            // Vérifier si tous les champs nécessaires sont remplis
            if (HelpersFunction::checkValueOfArrayIsEmpty([$noms, $prenom, $adresse, $date, $circonstance, $numero_serie, $marque])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }


            $new_declarationarme = new DeclarationArme();
            $new_declarationarme->nom = $noms;
            $new_declarationarme->id = \Illuminate\Support\Str::uuid();
            $new_declarationarme->prenom = $prenom;
            $new_declarationarme->adresse = $adresse;
            $new_declarationarme->date =$date;
            $new_declarationarme->circonstance =$circonstance;
            $new_declarationarme->numero_serie =$numero_serie;
            $new_declarationarme->marque = $marque;
            $new_declarationarme->photo = $photo;

            // Gérez le téléchargement de la photo si elle est présente
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('photos'), $imageName);
                $new_declarationarme->photo = $imageName;
            }

            $new_declarationarme->save();
            toastr()->success('Déclaration enregistrée avec succès');

            return redirect()->route('home');
        }catch(\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }
}
