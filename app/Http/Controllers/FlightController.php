<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        return Flight::join('cities as from_city', 'flights.from', '=', 'from_city.cityName')
            ->join('cities as to_city', 'flights.to', '=', 'to_city.cityName')
            ->select('flights.id', 'flights.flight_name', 'flights.date', 'flights.airline', "flights.price", "flights.number_of_seats", 'from_city.cityName as from_city', 'from_city.airport as from_airport', 'from_city.cityImage as from_image', 'to_city.cityName as to_city', 'to_city.airport as to_airport', 'to_city.cityImage as to_image')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_city' => 'required|string',
            'from_airport' => 'required|string',
            'from_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'to_city' => 'required|string',
            'to_airport' => 'required|string',
            'to_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'flight_name' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'airline' => 'required|string',
            'aircraft' => 'required|string',
            'seats' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
        ]);
        $img1 = $request->file("from_image")->getClientOriginalName();
        $img2 = $request->file("to_image")->getClientOriginalName();
        $fromCity = City::firstOrCreate(['cityName' => $request->from_city], ['airport' => $request->from_airport, 'cityImage' => $img1]);
        $toCity = City::firstOrCreate(['cityName' => $request->to_city], ['airport' => $request->to_airport, 'cityImage' => $img2]);
        $request->file("from_image")->move(public_path('images'), $img1);
        $request->file("to_image")->move(public_path('images'), $img2);

        $flight = new Flight([
            'flight_name' => $request->flight_name,
            'date' => $request->date,
            'airline' => $request->airline,
            'aircraft' => $request->aircraft,
            'number_of_seats' => $request->seats,
            'price' => $request->price
        ]);
        $flight->departureCity()->associate($fromCity);
        $flight->arrivalCity()->associate($toCity);
        $flight->save();

        return response()->json($flight, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Flight::join('cities as from_city', 'flights.from', '=', 'from_city.cityName')
            ->join('cities as to_city', 'flights.to', '=', 'to_city.cityName')
            ->select('flights.id', 'flights.flight_name', 'flights.date', 'flights.airline', "flights.price", "flights.number_of_seats", 'from_city.cityName as from_city', 'from_city.airport as from_airport', 'from_city.cityImage as from_image', 'to_city.cityName as to_city', 'to_city.airport as to_airport', 'to_city.cityImage as to_image')
            ->where('flights.id', '=', $id)
            ->get();
        return response()->json([
            "flight" => "hi",
        ], 200);
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
        return response()->json([
            $flight,
            204
        ]);
    }

    /**
     * get From  and To the form 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByFromToDate($from, $to, $date)
    {
        return Flight::with("departureCity")->where('from', $from)
            ->where('to', $to)
            ->whereDate('date', $date)
            ->get();
    }


    public function cheapestFlights()
    {
        $flights = Flight::where('price', '<', 400)->get();
        return response()->json($flights);
    }


    public function getByAirport($airport)
    {
        $flights = Flight::where('airport', 'LIKE', "%$airport%")->get();
        return response()->json($flights);
    }


    public function searchByDate($date)
    {
        $flight =  Flight::join('cities as from_city', 'flights.from', '=', 'from_city.cityName')
            ->join('cities as to_city', 'flights.to', '=', 'to_city.cityName')
            ->select('flights.id', 'flights.flight_name', 'flights.date', 'flights.airline', "flights.price", "flights.number_of_seats", 'from_city.cityName as from_city', 'from_city.airport as from_airport', 'from_city.cityImage as from_image', 'to_city.cityName as to_city', 'to_city.airport as to_airport', 'to_city.cityImage as to_image')
            ->where("flights.date", "LIKE", "%$date%")
            ->get();

        return response()->json($flight);
    }

    /**
     * Count the number of users in the database.
     *
     * @return int
     */
    public function CountFlights()
    {
        $CountFlights = Flight::count();
        return response()->json(['count' => $CountFlights]);
    }
}
