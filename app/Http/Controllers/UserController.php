<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Apartment;

class UserController extends Controller
{
    public function dashboard() {

        $messages = Message::all();

        $apartments = Apartment::all();

        $user = Auth::user();
        $messagesArray = [];
        $apartmentArray = [];

        foreach ($apartments as $apartment) {
            if ($apartment -> user_id == $user -> id) {
     
                foreach ($messages as $message) {

                    if ($apartment -> id == $message -> apartment_id) {
                        array_push($messagesArray, $message);
                    }
                }
            }
        }
        return view('pages.dashboard', compact('messagesArray'));
    }
}
