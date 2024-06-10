<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Boredom Buster</title>
</head>
<body>
    <h1>Random Activity Suggestion</h1>
    <p>{{ $activity->name }}</p>
    <p>Category: <a href="{{ route('category', $activity->category) }}">{{ $activity->category }}</a></p>
</body>
</html>
