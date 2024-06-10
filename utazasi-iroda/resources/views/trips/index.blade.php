<!DOCTYPE html>
<html>
<head>
    <title>Trips</title>
</head>
<body>
    <h1>Trips by Country</h1>
    <ul>
        @foreach ($trips as $country => $tripList)
            <li>
                <a href="{{ route('trips.showByCountry', ['country' => $country]) }}">{{ $country }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
