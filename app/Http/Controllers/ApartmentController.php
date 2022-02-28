<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {

        $data = $request->validate([
            
        ]);


        return redirect()->route('apartment.show');
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
