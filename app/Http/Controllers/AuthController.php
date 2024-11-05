<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the input data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Retrieve the admin by username
        $admin = Admin::where('username', $credentials['username'])->first();

        // Check if the admin exists and if the password is correct
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Log in the admin and set session variable
            Auth::login($admin);
            session(['is_admin' => true]); // Store admin status in session

            return response()->json([
                'status' => 'success',
                'username' => $admin->username
            ]);
        }

        // If login fails, return an error response
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials.'
        ], 401);
    }



public function logout(Request $request)
{
    Log::info('Logout method called'); // Add this line

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}


}
