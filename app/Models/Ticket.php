<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "flight_id", 
        "user_id"
    ] ;

    public function flight(){
        return $this->belongsTo(Flight::class) ;
    }

    public function user(){
        return $this->belongsTo(User::class) ;
    }
}
