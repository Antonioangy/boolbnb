<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

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
    }
}
