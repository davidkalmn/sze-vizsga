<!DOCTYPE html>
<html>
<head>
    <title>Trips to {{ $country }}</title>
</head>
<body>
    <h1>Trips to {{ $country }}</h1>
    <ul>
        @foreach ($trips as $trip)
            <li>
                Date: {{ $trip->date }}, Price: ${{ $trip->price }}, Vehicle: {{ $trip->vehicle }}
            </li>
        @endforeach
    </ul>
    <a href="{{ route('trips.index') }}">Back to all trips</a>
</body>
</html>
