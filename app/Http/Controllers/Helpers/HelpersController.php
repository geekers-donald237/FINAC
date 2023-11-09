<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HelpersController extends Controller
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

    public static  function updateUserRole($email , $new_role_number)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->user_type = $new_role_number;
            $user->save();
        }
    }

    public static function checkIfEmailAlreadyExit($email): bool
    {
        // Vérifier si l'e-mail existe déjà
        $existingUser = User::where('email', $email)->first();

        return $existingUser ? true : false;
    }

    public static function validatePasswords($password1, $password2)
    {
        // Vérifier si les deux mots de passe ont au moins 8 caractères
        if (strlen($password1) < 8 || strlen($password2) < 8) {
            return false;
        }

        // Vérifier si les deux mots de passe sont égaux
        if ($password1 !== $password2) {
            return false;
        }

        // Si toutes les conditions sont remplies, les mots de passe sont valides
        return true;
    }



}
