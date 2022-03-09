<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    // lista appartamenti dell'utente loggato
    public function getApartmentUserList() {
        
        $userApartments = Apartment::where('user_id', Auth::user()->id)->get();

        return json_encode($userApartments);
    }

    // ricerca appartamenti
    public function searchApartments($lng, $lat, $radius, $nRooms, $nBeds) {


        $apartments = DB::table('apartments')
                        -> where('rooms', '>=', $nRooms)
                        -> where('beds', '>=', $nBeds)
                        // -> join('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
                        // -> join('services', 'services.id', '=', 'apartment_service.service_id')
                        // -> where('services.name', $selectedServices)
                        // -> select('apartments.*', 'services.id as service_id', 'services.name as service_name')
                        -> orderBy('sponsor', 'desc')
                        -> get();
        

        $apartmentsInRange = [];

        foreach ($apartments as $apartment) {

            // raggio di ricarca default 20km
            if ($this->haversineGreatCircleDistance($lat, $lng, $apartment->latitude, $apartment->longitude) < $radius) {
                array_push($apartmentsInRange, $apartment);
            }
        }
        
        return json_encode($apartmentsInRange);
    }


    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */

    // funzione per calcolare distanza tra due punti
    public function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function getServices()
    {

        $services = Service::all();

        return json_encode($services);
    }
}