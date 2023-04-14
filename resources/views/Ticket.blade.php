<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <section class="ticketContainer">
            <h1>Your Flights</h1>
            <div class="row mt-4">
                @foreach ($getSearchedFlight as $ticket)
                    <article class="card fl-left">
                        <h4 class="text-center text-dark">{{ auth()->user()?->name }}</h4>
                        <section class="date">
                            <time>
                                <span>{{ explode(' ', $formattedDate)[0] }}</span>
                                <span>{{ explode(' ', $formattedDate)[1] }}</span>
                            </time>
                            <h5 v-if="ticket" class="text-danger text-decoration-underline">{{ $ticket?->price }} DH
                            </h5>
                        </section>

                        <section class="card-cont">
                            <div class="even-date">
                                <i class="fa fa-map-marker text-danger"></i>
                                <b class="mx-4 p-2">Departure : {{ $ticket->from }}</b>
                                <h3>{{ $getSearchedFlight?->flight_name }}</h3>
                            </div>

                            <div class="even-date">
                                <i class="fa-sharp fa-solid fa-plane-departure text-success"></i>
                                <span class="mx-4 p-2">Airport : {{ $ticket?->departure_city->airport }}</span>
                            </div>

                            <div class="even-date">
                                <i class="fa-brands fa-bandcamp text-warning"></i>
                                <span class="mx-4 p-2">Airline : {{ $ticket?->airline }}</span>
                            </div>

                            <div class="even-date">
                                <i class="fa fa-calendar text-secondary"></i>
                                <time>
                                    <span class="mx-4 p-2 text-danger">
                                        Time : {{ $formattedDate->format('H:i') }}
                                    </span>
                                </time>
                            </div>

                            <div class="even-info">
                                <i class="fa fa-map-marker text-danger"></i>
                                <b class="mx-4 p-2">Arrival : {{ $ticket?->to }}</b>
                            </div>

                            <a href="{{ route('Payement', $ticket?->id) }}" class="bg-danger text-white">Book
                                tickets</a>
                        </section>

                        <section class="from_to">
                            <div class="inFromTo container bg-white">
                                <span>Casablanca</span>
                                <h3><i class="fa-sharp fa-solid fa-plane-circle-check fa-bounce"></i></h3>
                                <span>Agadir</span>
                            </div>
                        </section>
                    </article>
                @endforeach
            </div>
            <div class="row"></div>
        </section>

    </div>
</body>

</html>
