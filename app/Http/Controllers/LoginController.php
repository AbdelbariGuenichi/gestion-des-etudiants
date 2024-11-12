<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        session(['remember_token' => $request->input('remember_token')]);
        if (Auth::guard('admin')->attempt($credentials, false)) {
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    Auth::guard('admin')->logout();
    session()->forget('remember_token');
    return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
        }
