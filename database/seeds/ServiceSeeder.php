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

        factory(Service::class, 5) -> make() -> each(function ($service) {
            // $services = config('apartment_services');

            // foreach ($services as $service) {
            //     $newService = new Service;

            // $newService -> name = $service;

            $apartment = Apartment::inRandomOrder() -> limit(rand(0, 3)) ->get();
            
            
            $service -> apartments() -> attach($apartment);
            
            $service -> save();
        });
        
    }
}
