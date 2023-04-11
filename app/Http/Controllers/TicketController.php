<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        // $tickets = Ticket::with('user', 'flight')->get();
        // return response()->json($tickets);
        return response()->json(["hii"]) ;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flight_id' => 'required',
            'passenger_id' => 'required',
            'price' => 'required',
            'number' => 'required',
        ]);

        $ticket = new Ticket;
        $ticket->flight_id = $validatedData['flight_id'];
        $ticket->passenger_id = $validatedData['passenger_id'];
        $ticket->price = $validatedData['price'];
        $ticket->number = $validatedData['number'];
        $ticket->save();

        return response()->json([
            'message' => 'Ticket created successfully',
            'ticket' => $ticket
        ]);
    }

    public function test(){
        return "hii" ;
    }
}
