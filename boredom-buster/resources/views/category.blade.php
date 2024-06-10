<!-- resources/views/category.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ $category }} Activities</title>
</head>
<body>
    <h1>Random Activity from {{ $category }}</h1>
    <p>{{ $activity->name }}</p>
    <a href="{{ route('home') }}">Go back</a>
</body>
</html>
