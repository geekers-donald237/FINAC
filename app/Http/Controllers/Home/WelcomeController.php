<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\State;
use App\Models\internaltionalison\District;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

        return view('welcome.welcome');
    }

    public function infoAndContactPage()
    {

        return view('welcome.info_contact');
    }
    public function goTocreateArmory()
    {

        $states = State::orderBy('name', 'asc')->get();
        return view('welcome.create_armory',compact('states'));
    }
}
