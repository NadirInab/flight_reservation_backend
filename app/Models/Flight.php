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
        'from',
        'to',
        'airport',
        'airline',
        'aircraft',
        'price',
        'number_of_seats',
    ];
}
