<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Service;

class ApartmentController extends Controller
{
    public function show($id) {

        $apartment = Apartment::findOrFail($id);

        return view('pages.apartment.show', compact('apartment'));
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
        ]);
    
        $image = $request -> file('images');
        $imageName = rand(1000, 999999) . '_' .time() . '.' . $image -> getClientOriginalExtension();

        $image -> storeAs('/assets/', $imageName, 'public');


        $data['images'] = $imageName;
        
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

        return view('pages.apartment.edit', compact('apartment','services'));
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
        ]);

        $image = $request -> file('images');
        $imageName = rand(1000, 999999) . '_' .time() . '.' . $image -> getClientOriginalExtension();

        $image -> storeAs('/assets/', $imageName, 'public');


        $data['images'] = $imageName;
        
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

        $apartment -> services() -> sync([]);
        $apartment -> save();

        $apartment -> delete();

        return redirect() -> route('user.dashboard');
    }
}
