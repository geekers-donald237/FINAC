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


}
