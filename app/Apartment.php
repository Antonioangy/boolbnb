<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'rooms',
        'beds',
        'bathrooms',
        'sq',
        'images',
        'sponsor',
        'latitude',
        'longitude',
        'address',
        'deleted',
    ];

    public function user() {

        return $this-> belongsTo(User::class);
    }

    public function messages() {
        
        return $this-> hasMany(Message::class);
    }

    public function views() {
        
        return $this-> hasMany(View::class);
    }

    public function services() {

        return $this-> belongsToMany(Service::class);
    }

    public function sponsors() {

        return $this-> belongsToMany(Sponsor::class, 'apartment_sponsor', 'apartment_id', 'sponsor_id') -> withTimestamps() -> withPivot('end_date');
    }
}
