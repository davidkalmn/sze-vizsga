<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            @error('username')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <!-- Hidden input for redirect URL -->
        <input type="hidden" name="redirect_to" value="{{ url('/tasks') }}">
        <button type="submit">Login</button>
    </form>
</body>
</html>
