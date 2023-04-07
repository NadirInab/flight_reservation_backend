<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Flight::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request) ;
        $flight = Flight::create($request->all());

        return response()->json($flight, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Flight::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->update($request->all());

        return response()->json($flight, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();
        // return "HJHJHJH" ;
        return response()->json([
            $flight,
            204
        ]);
    }


    /**
     * show by date 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByDate($date)
    {
        return Flight::where('date', $date)->get();
    }


    /**
     * get From  and To the form 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByFromTo($from, $to)
    {
        return Flight::where('from', $from)
            ->where('to', $to)
            ->get();
    }

    /**
     * get From  and To the form 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByFromToDate($from, $to, $date)
    {
        return Flight::where('from', $from)
            ->where('to', $to)->where('date', $date)
            ->get();
    }


    public function cheapestFlights()
    {
        $flights = Flight::where('price', '<', 500)->get();
        return response()->json($flights);
    }

    public function searchByPrice($price)
    {
        $flights = Flight::where('price', '=', $price)->get();
        return response()->json($flights);
    }


    public function getByAirport($airport)
    {
        $flights = Flight::where('airport', 'LIKE', "%$airport%")->get();
        return response()->json($flights);
    }
}
