<?php

use Illuminate\Database\Seeder;
use App\Service;

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

            $newService -> save();
        }
    }
}
