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
        if (Auth::guard('admin')->attempt($credentials, false)) { // false disables "Remember Me"
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    /*public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = DB::table('admins')
            ->where('username', $request->username)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            return redirect()->route('welcome-admin')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors(['username' => 'Admin Invalid'])->withInput();
    }*/

    // public function logout()
    // {
    //     Auth::guard('admin')->logout();
    //     return redirect()->route('login')->with('success', 'Logged out successfully!');
    // }
    public function logout(Request $request)
    {
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    Auth::guard('admin')->logout();
    session()->forget('remember_token');
    return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
        }
