<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Service;
use App\Message;

class ApartmentController extends Controller
{
    public function show($id) {

        $apartment = Apartment::findOrFail($id);
        $services = Service::all();
        $user = Auth::user();

        return view('pages.apartment.show', compact('apartment', 'user', 'services'));
    }

    public function create()
    {

        $services = Service::all();

        return view('pages.apartment.create', compact('services'));
    }

    public function store(Request $request){

        $data = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'rooms' => 'integer',
            'beds' => 'integer',
            'bathrooms' => 'integer',
            'sq' => 'integer',
            'address' => 'string',
            'latitude' => 'string',
            'longitude' => 'string'
        ]);

        $image = $request -> file('images');

        if ($image) {

            $imageName = rand(1000, 999999) . '_' . time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('/assets/', $imageName, 'public');

            $data['images'] = $imageName;
        }
        
        $data['author'] = Auth::user() -> name;
        
        
        $apartment = Apartment::make($data);
        
        $user = Auth::user()->id;

        $apartment -> user()->associate($user);

        $apartment -> save();
        
        $services = [];

        try {

            $services = Service::findOrFail($request -> get('services'));

        } catch (\Exception $e) { }

        $apartment -> services() -> attach($services);
        
        $apartment -> save();

        return redirect()->route('apartment.show', $apartment -> id);
    }

    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);

        $services = Service::all();

        if ($apartment->user_id == Auth::user()->id) {

            return view('pages.apartment.edit', compact('apartment','services'));
        } else {

            return redirect()->route('user.dashboard');
        }
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'rooms' => 'integer',
            'beds' => 'integer',
            'bathrooms' => 'integer',
            'sq' => 'integer',
            'address' => 'string',
            'latitude' => 'string',
            'longitude' => 'string'
        ]);

        $image = $request -> file('images');

        if ($image) {

            $imageName = rand(1000, 999999) . '_' .time() . '.' . $image -> getClientOriginalExtension();
    
            $image -> storeAs('/assets/', $imageName, 'public');
    
            $data['images'] = $imageName;
        }
        
        $data['author'] = Auth::user() -> name;
        
        $apartment = Apartment::findOrFail($id);

        $apartment -> update($data);
        
        $services = [];

        try {

            $services = Service::findOrFail($request -> get('services'));

        } catch (\Exception $e) { }

        $apartment -> services() -> sync($services);
        
        $apartment -> save();


        return redirect()->route('apartment.show', $apartment->id);
    }

    public function delete($id)
    {
        $apartment = Apartment::findOrFail($id);

        if ($apartment -> user_id == Auth::user() -> id) {

            $apartment -> services() -> sync([]);
            $apartment -> sponsors()-> sync([]);
            $apartment -> messages()-> delete();
            $apartment -> views() -> delete();

            $apartment -> save();
    
            $apartment -> delete();
        }

        return redirect() -> route('user.dashboard');
    }

    /* messages */

    public function message_send(Request $request, $id) {

        $data = $request->validate([
            'sender' => 'email',
            'text' => 'string',
        ]);

        $message = Message::make($data);

        $apartment = Apartment::findOrFail($id);

        $message -> apartment()->associate($apartment);

        $message -> save();

        return redirect()->route('apartment.show', $apartment->id);
    }

}
