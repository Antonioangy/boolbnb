<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'price',
    ];

    public function apartments() {
        
        return $this-> belongsToMany(Apartment::class, 'apartment_sponsor', 'sponsor_id', 'apartment_id') -> withTimestamps() -> withPivot('end_date');
    }
}