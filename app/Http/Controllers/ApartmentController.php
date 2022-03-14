<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Service;
use App\Message;
use App\View;
use App\Sponsor;
use Session;
use Stripe;

class ApartmentController extends Controller
{
    public function show($id) {

        $apartment = Apartment::findOrFail($id);
        $services = Service::all();
        $user = Auth::user();

        $apartmentUser = User::findOrFail($apartment -> user_id);
        $views = View::where('apartment_id', $id ) -> count();

        $newView = View::make();
        $newView -> apartment_id = $id;
        $newView -> save();
        

        return view('pages.apartment.show', compact('apartment', 'user', 'services', 'views', 'apartmentUser'));
    }

    public function create(){

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

    public function edit($id){
        $apartment = Apartment::findOrFail($id);

        $services = Service::all();

        if ($apartment->user_id == Auth::user()->id) {

            return view('pages.apartment.edit', compact('apartment','services'));
        } else {

            return redirect()->route('user.dashboard');
        }
    }

    public function update(Request $request, $id){

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

    public function delete($id){
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

    /* sponsor */

    public function sponsor($id) {
        $apartment = Apartment::findOrFail($id);

        return view('pages.apartment.sponsor', [
        'apartment' => $apartment
        ]);
    }

    public function sponsorCheckout(Request $request, $id) {

        $apartment = Apartment::findOrFail($id);

        $standard = DB::table('sponsors')->where('duration', 24)->value('duration');
        $premium = DB::table('sponsors')->where('duration', 72)->value('duration');
        $elite = DB::table('sponsors')->where('duration', 144)->value('duration');

        $standardRow = Sponsor::where('duration', 24)->get();
        $premiumRow = Sponsor::where('duration', 72)->get();
        $eliteRow = Sponsor::where('duration', 144)->get();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request -> amount * 100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Livello scelto: ". $request -> amount,
        ]);
        Session::flash('success', 'Pagamento avvenuto con successo!');

        if ($request -> amount == 2.99) {
            $level = $standard;
            $sponsor = $standardRow;
        }elseif ($request -> amount == 5.99) {
            $level = $premium;
            $sponsor = $premiumRow;
        }else {
            $level = $elite;
            $sponsor = $eliteRow;
        }

        $now = date_create();
        date_add($now, date_interval_create_from_date_string("$level hours"));
        $expiration = date_format($now, 'Y-m-d H:i:s');

        $apartment -> sponsor = 1;
        $apartment -> save();
        
        $apartment -> sponsors() -> attach($sponsor,['end_date' => $expiration]);
        
        return back();
    }

}
