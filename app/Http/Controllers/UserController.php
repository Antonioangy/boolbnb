<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Apartment;
use App\View;

class UserController extends Controller
{
    public function dashboard() {

        $messages = Message::all() -> sortBy('created_at');

        $apartments = Apartment::all();

        $user = Auth::user();
        

        $obj = [];

        foreach ($apartments as $apartment) {
            if ($apartment -> user_id == $user -> id) {
     
                foreach ($messages as $message) {

                    if ($apartment -> id == $message -> apartment_id) {
                        
                        array_push($obj, (object)[
                            'message' => $message,
                            'apartment' => $apartment
                        ]);
                    }
                }
            }
            $views = View::where('apartment_id', $apartment -> id ) -> count();
        }

        

        return view('pages.dashboard', compact('obj', 'views'));
    }
}
