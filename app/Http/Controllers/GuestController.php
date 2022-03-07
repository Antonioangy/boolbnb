<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;
use App\Sponsor;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function home() {

        /* $apartment = Apartment::find(1);
        $sponsor = Sponsor::find(1);
        dd($apartment);

        foreach ($apartment -> sponsors as $sponsor) {
            dd($sponsor->pivot->created_at);
        } */

        // $apartments = Apartment::all();

        $sponsoredApartments = Apartment::where('sponsor', true) -> get();

        return view('pages.home', compact('sponsoredApartments'));
    }

    public function apartmentsResults() {

            
        return view('pages.apartmentsResults');
    }

    
}
