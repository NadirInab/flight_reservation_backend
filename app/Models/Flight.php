<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
