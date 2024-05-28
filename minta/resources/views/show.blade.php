<!DOCTYPE html>
<html>
<head>
    <title>{{ $destination->name }}</title>
</head>
<body>
    <h1>{{ $destination->name }}</h1>
    <h2>Indulási időpontok és árak</h2>
    <ul>
        @forelse ($destination->trips as $trip)
            <li>
                <strong>Közlekedési eszköz:</strong> {{ $trip->transportation->type }}
                <div>
                    @forelse ($trip->tripDates as $date)
                        <p>Időpont: {{ $date->date }} - Ár: {{ $trip->price }} Ft</p>
                    @empty
                        <p>Nincs elérhető indulási időpont.</p>
                    @endforelse
                </div>
            </li>
        @empty
            <li>Nincsenek elérhető utazások.</li>
        @endforelse
    </ul>
    <a href="{{ url('/') }}">Vissza a főoldalra</a>
</body>
</html>