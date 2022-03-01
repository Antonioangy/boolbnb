<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ApartmentController extends Controller
{
    public function show($id) {

        $apartment = Apartment::findOrFail($id);

        return view('pages.apartment.show', compact('apartment'));
    }

    public function create()
    {

        return view('pages.apartment.create');
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
        

        return redirect()->route('apartment.show', $apartment -> id);
    }

    public function edit($id)
    {

        $apartment = Apartment::findOrFail($id);

        return view('pages.edit', compact('apartment', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            
        ]);

        $apartment = Apartment::findOrFail($id);

        return redirect()->route('show', $apartment->id);
    }

    public function delete($id)
    {

        $apartment = Apartment::findOrFail($id);

        return redirect()->route('');
    }
}
