<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelpersController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function userLogin(Request $request)
    {
        try {

            $email = $request->email;
            $password = $request->password;

            if (HelpersController::checkValueOfArrayIsEmpty([$email , $password ])) {
                throw new \Exception(' fill all fields');
            }
            $user = User::where('email', $email)->first();

            if ($user) {
                if (password_verify($password , $user->password)) {
                    Auth::login($user);
                    return view('dashboard.dashboard');
                } else {
                    throw new \Exception(' email or password incorrect');
                }
            } else {
                throw new \Exception(' email or password incorrect');
            }
        }catch (\Exception $e){
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

    public function registerUser(Request $request)
    {
        try {

            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $email = $request->input('email');
            $telephone = $request->input('telephone');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');

            // Vérifier si tous les champs sont remplis
            if ( HelpersController::checkValueOfArrayIsEmpty([$firstname , $lastname , $email,$telephone , $password, $confirm_password])) {
                throw new \Exception(' fill all fields');
            }

            if (HelpersController::checkIfEmailAlreadyExit($email)) {
                throw new \Exception('email Already exist');
            }

            if (!HelpersController::validatePasswords($password, $confirm_password)){
                throw new \Exception(' wrong password');
            }

            // Créer un nouvel utilisateur
            $newUser = new User();
            $newUser->firstname = $firstname;
            $newUser->lastname = $lastname;
            $newUser->email = $email;
            $newUser->telephone = $telephone;
            $newUser->password = $password;
            $newUser->save();
            toastr()->success('success message');
            return redirect()->back();
        }catch (\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back();

        }
    }

    public function logout_dashboard()
    {
        Session::flush();

        Auth::logout();

//        return redirect('login');
        return redirect(url(''));
    }

}
