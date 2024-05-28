<!DOCTYPE html>
<html>
<head>
    <title>Világraszóló Utazási Iroda</title>
</head>
<body>
    <h1>Világraszóló utazási iroda</h1>
    <h2>Utazási célpontok:</h2>
    <ul>
        @foreach ($destinations as $destination)
            <li>
                <a href="{{ route('destinations.show', $destination->id) }}">{{ $destination->name }}</a>
                <ul>
                    @foreach ($destination->trips as $trip)
                        <li>{{ $trip->transportation->type }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    {{ $destinations->links() }}
</body>
</html>