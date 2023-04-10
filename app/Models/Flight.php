<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_name',
        'date',
        'airline',
        'aircraft',
        'price',
        'number_of_seats',
    ];
    
    public function departureCity()
    {
        return $this->belongsTo(City::class, 'from', 'cityName');
    }

    public function arrivalCity()
    {
        return $this->belongsTo(City::class, 'to', 'cityName');
    }
}
