<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\Apartment;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        $services = config('apartment_services');

        foreach ($services as $service) {
            $newService = new Service;

            $newService -> name = $service;

            $apartment = Apartment::inRandomOrder() -> limit(rand(0, 3)) ->get();
            
            $newService -> save();
            
            $newService -> apartments() -> attach($apartment);
            
        }
        
    }
}
