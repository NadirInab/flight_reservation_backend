<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user', 'flight')->get();
        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flight_id' => 'required',
            'user_id' => 'required',
        ]);

        $ticket = new Ticket;
        $ticket->flight_id = $validatedData['flight_id'];
        $ticket->user_id = $validatedData['user_id'];
        $ticket->save();

        return response()->json([
            'message' => 'Ticket has been booked successfully',
            'ticket' => $ticket
        ]);
    }

    public function ticketsCount(){
        $ticketsCount = Ticket::count() ;
        return response()->json(["ticketsCount" => $ticketsCount]) ;
    }

    public function getUserTickets($id){
        $userTicket = Ticket::where("user_id" , $id)->get() ;
        return response()->json(["userTicket" => $userTicket]) ;
    }

    public function destroy($id){
        $ticket = Ticket::find($id) ;
        $ticket->delete() ;
        return response()->json([
            "ticket" => $ticket, 
            "message" => "ticket has been deleted successfully" 
        ]) ;
    }
}
