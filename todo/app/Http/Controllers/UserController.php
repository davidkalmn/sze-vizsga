<?php

// app/Http/Controllers/UserController.php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Ensure the User model is imported

class UserController extends Controller
{
    public function showProfile()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->username = $request->input('username');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('tasks.index')->with('success', 'Profile updated successfully.');
    }
}
