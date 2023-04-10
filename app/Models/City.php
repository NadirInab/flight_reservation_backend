<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'cityName', 
        "airport", 
        "cityImage"
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
