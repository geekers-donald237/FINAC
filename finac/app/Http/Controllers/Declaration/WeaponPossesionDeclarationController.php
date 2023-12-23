<?php

namespace App\Http\Controllers\Declaration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\declaration\WeaponPossesionDeclaration;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;


class WeaponPossesionDeclarationController extends Controller
{

    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {

        return view('weaponsdeclaration.possession_weapon_declaration');
    }


    public function store(Request $request): RedirectResponse
    {
        try {
            $fullname = $request->fullname;
            $phone_number = $request->phone_number;
            $email = $request->email;
            $adresse = $request->adress;
            $serial_number = $request->serial_number;
            $weapon_type = $request->weapon_type;
            $circonstance = $request->circumstances;

            // Vérifier si tous les champs nécessaires sont remplis
            if (HelpersFunction::checkValueOfArrayIsEmpty([$fullname, $phone_number, $email, $adresse, $serial_number, $weapon_type, $circonstance])) {
                throw new \Exception('Veuillez remplir tous les champs');
            }

            $weapon_possesion = new WeaponPossesionDeclaration();


            if ($request->hasFile('cni')) {
                $filename = HelpersFunction::handleFileUpload($request->file('cni'), 'public/finac/weapon_possesion/cni');
                $weapon_possesion->cni = $filename;
            }

            if ($request->hasFile('weapon_picture')) {
                $filename = HelpersFunction::handleFileUpload($request->file('weapon_picture'), 'public/finac/weapon_possesion/weapon_picture');
                $weapon_possesion->weapon_picture = $filename;
            }

            $weapon_possesion->id = Uuid::uuid4()->toString();
            $weapon_possesion->fullname = $fullname;
            $weapon_possesion->phone_number = $phone_number;
            $weapon_possesion->email = $email;
            $weapon_possesion->adress = $adresse;
            $weapon_possesion->serial_number = $serial_number;
            $weapon_possesion->weapon_type = $weapon_type;
            $weapon_possesion->circumstances = $circonstance;

            $weapon_possesion->save();

            $this->sendEmail($weapon_possesion->email, $weapon_possesion->weapon_type);

            toastr()->success('Déclaration enregistrée avec succès');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    private function sendEmail(string $recipientEmail, string $weaponType): void
    {
        try {
            // Personnalisez le contenu de l'e-mail en fonction du type d'arme déclaré
            $emailContent = "Merci pour votre déclaration. Si vous possédez une arme de type $weaponType, veuillez vous diriger vers le service du gouverneur de votre région.";

            Mail::send([], [], function ($message) use ($recipientEmail, $emailContent) {
                $message->to($recipientEmail)
                    ->subject('Confirmation de déclaration')
                    ->setBody($emailContent, 'text/html');
            });
        } catch (\Exception $e) {
            // Gérer les erreurs d'envoi d'e-mail
            toastr()->error('Erreur lors de l\'envoi de l\'e-mail de confirmation');
        }
    }

}
