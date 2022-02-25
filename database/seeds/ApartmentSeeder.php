<?php

use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('apartments');

        foreach ($apartments as $apartment) {
            $newApartment = new Apartment;

            $newApartment -> title = $apartment['title'];
            $newApartment -> description = $apartment['description'];
            $newApartment -> rooms = $apartment['rooms'];
            $newApartment -> beds = $apartment['beds'];
            $newApartment -> sq = $apartment['sq'];
            $newApartment -> images = $apartment['images']; 
            $newApartment -> sponsor = $apartment['sponsor'];
            $newApartment -> latitude = $apartment['latitude'];
            $newApartment -> longitude = $apartment['longitude']; 
            $newApartment -> address = $apartment['address'];
            $newApartment -> deleted = $apartment['deleted'];

            $user = User::inRandomOrder() -> first();

            $newApartment -> user() -> associate($user);

            $newApartment -> save();
        }
    }
}
