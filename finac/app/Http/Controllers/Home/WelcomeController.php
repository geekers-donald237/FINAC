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

        $departments = Departement::orderBy('name', 'asc')->get();
        $districts = District::all();
        return view('welcome.create_armory',compact('departments', 'districts'));
    }
}
