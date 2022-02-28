<?php

use Illuminate\Database\Seeder;
use App\Sponsor;
use App\Apartment;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = config('sponsors');

        foreach ($sponsors as $sponsor) {
            $newSponsor = new Sponsor;

            $newSponsor -> name = $sponsor['name'];
            $newSponsor -> duration = $sponsor['duration'];
            $newSponsor -> price = $sponsor['price'];

            $newSponsor -> save();
        }

        $apartments = Apartment::where('sponsor', true) -> get();

        foreach ($apartments as $apartment) {  
            $randomSponsor = Sponsor::all()->random();

            $randomSponsor -> apartments() -> attach($apartment, ['end_date' => '2022-02-08 15:47:45']);
        }
    }
}