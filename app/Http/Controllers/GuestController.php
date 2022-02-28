<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function home() {

        $apartments = Apartment::all();

        return view('pages.home', compact('apartments'));
    }

    public function access() {

        return view('pages.access');
    }
}
