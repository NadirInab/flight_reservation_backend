<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('payment','user', 'flight')->get();
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

    public function sendImageToEmail(Request $request)
    {
        $image = $request->file('image');
        $path = $image->store('images');

        // $email = 'inabnadir313@gmail.com';
        $email = 'nadir.inab.dev@gmail.com';
        // $email2 = 'nadir.inab.dev@gmail.com';

        Mail::send([], [], function ($message) use ($path, $email) {
            $message->to($email)
                ->subject('Ticket')
                ->from('inabnadir313@gmail.com', 'Nadir')
                ->attach(storage_path('app/' . $path));
        });

        return response()->json(['success' => $request]);
    }
}
