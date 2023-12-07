<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersFunction;
use App\Models\armory\Account;
use App\Models\armory\Armory;
use App\Models\user\User;
use App\Models\weapons\WeaponType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $login = $request->login;
            $password = $request->password;

            if (HelpersFunction::checkValueOfArrayIsEmpty([$login, $password])) {
                throw new \Exception('Fill all fields');
            }

            $user = User::where('generated_login', $login)->first();
            if ($user && password_verify($password, $user->generated_password)) {
                Auth::login($user);
                if ($user->prefix == 'armory') {
                    return redirect()->route('armory.index');
                } elseif ($user->prefix == 'minatd') {
                    return redirect()->route('minatd.index');
                } elseif ($user->prefix == 'governor') {
                    return redirect()->route('governor.index');
                } elseif ($user->prefix == 'prefecture') {
//                    return redirect()->route('prefecture.dashboard');
                } elseif ($user->prefix == 'admin') {
                    return redirect()->route('admin.index');
                } else {
                    throw new \Exception('Unknown user prefix');
                }
            } else {
                throw new \Exception('Login or password incorrect');
            }
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(url(''));
    }


    public function logout_dashboard()
    {
        Session::flush();

        Auth::logout();

//        return redirect('login');
        return redirect(url(''));
    }

}
