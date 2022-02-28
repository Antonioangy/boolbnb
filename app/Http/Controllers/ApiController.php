<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    // lista appartamenti dell'utenete loggato
    public function getApartmentUserList() {
        
        $userApartments = Apartment::where('user_id', Auth::user()->id)->get();

        return json_encode($userApartments);
    }
}
