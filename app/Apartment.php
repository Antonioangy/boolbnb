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
        'sq',
        'images',
        'sponsor',
        'latitude',
        'longitude',
        'address',
        'deleted',
    ];
}
