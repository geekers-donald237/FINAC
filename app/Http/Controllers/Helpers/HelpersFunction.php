<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\MailController;
use App\Models\armory\HoldersWeapon;
use App\Models\PermissionsPort;
use App\Models\user\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class HelpersFunction extends Controller
{
    public static function checkValueOfArrayIsEmpty(array $values)
    {
        foreach ($values as $value) {
            if (empty($value)) {
                return true;
            }
        }
        return false;
    }

    public static function generateUniqueLogin($username) {
        $namePart = strtolower(substr($username, 0, 3)); // Prend les 3 premières lettres du nom
        $randomDigits = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT); // Génère un nombre aléatoire de 4 chiffres

        $login = $namePart . $randomDigits;

        $suffix = 0;
        while (User::where('generated_login', $login)->exists()) {
            $login = $namePart . ++$suffix . $randomDigits; // Ajoute un suffixe si le login est déjà utilisé
        }

        return $login;
    }


    public static function generateStrongPassword($length = 5) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, $length);

        return $password;
    }

    public static function handleFileUpload(UploadedFile $file, string $storagePath)
    {
        $filename = time() . $file->getClientOriginalName();
        $file->storeAs($storagePath, $filename);

        return $filename;
    }

    public static function generateRandomCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';

        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $code;
    }

    private function updatePermissionsPort($permissionsPortId, $code
    )
    {
        try {
            $permissionsPort = PermissionsPort::find($permissionsPortId);
            $idService = Auth::user()->id;
            if ($permissionsPort) {
                $updateResult = $permissionsPort->update(['statut' => 'accepte', 'code_finac' => $code, 'validate_from_id' => $idService]);
                return $updateResult;
            }

            return false;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function generateFINACCode($permissionsPortId)
    {
        $code = $this->generateRandomCode();
        $updateResult = $this->updatePermissionsPort($permissionsPortId, $code);

        if ($updateResult) {
            return response()->json('success');
        } else {
            return response()->json(['error' => 'Échec de la mise à jour']);
        }
    }

 public static function getCodeFinacFromPermissionPortId($permissionPortId) {
        try {
            // Récupérer le modèle PermissionPort
            $permissionsPort = PermissionsPort::findOrFail($permissionPortId);

            // Vérifier si le modèle a un attribut "codeFinac"
            if (!$permissionsPort->code_finac) {
                throw new \Exception('Le modèle PermissionPort ne contient pas de code Finac.');
            }

            // Retourner le code Finac
            return $permissionsPort->code_finac;
        } catch (\Exception $e) {
            // Gérer l'erreur et renvoyer null ou une valeur par défaut selon vos besoins
            return null;
        }
    }

    function rejectPermissionsPort($permissionsPortId, Request $request) {
        try {
            $motifRefus = $request->input('motif_refus');
            $email = $request->input('email');
            PermissionsPort::where('id', $permissionsPortId)->update([
                'statut' => 'rejete',
                'motif_refus' => $motifRefus,
            ]);
             self::permissionsPortDeniedEmail($email,$motifRefus);
            return redirect()->route('minatd.index');

        } catch (Exception $e) {
           dd($e->getMessage());
        }
    }

    public static function sendEmail($login , $password , $email)
    {
        MailController::sendMail(email: $email, login: $login, password: $password);
    }
  public static function permissionsPortDeniedEmail($email , $motifRefus)
    {
        MailController::sendPermissionsPortDeniedMail(email: $email, motifRefus: $motifRefus);
    }


    public function savePdf(Request $request)
    {
        try {
            $pdfData = $request->input('pdfData');
            $email = $request->input('email');
            $decodedPdfData = base64_decode(preg_replace('#^data:application/\w+;base64,#i', '', $pdfData));

            $filename = 'fiche' . time() . '.pdf';
            $filePath = storage_path('app/public/finac/' . $filename);

            file_put_contents($filePath, $decodedPdfData);

            // Envoi du mail avec le fichier attaché
            $fileAttachmentPath = storage_path('app/public/finac/' . $filename);
            MailController::sendEmailWithFileAttachment($email , $fileAttachmentPath);

            return response()->json(['success' => true, 'filename' => $fileAttachmentPath]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


}
