<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class GuestController extends Controller
{
    public function home() {

        $apartments = Apartment::all();

        return view('pages.home', compact('apartments'));
    }
}
