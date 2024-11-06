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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = DB::table('admins')
            ->where('username', $request->username)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            return redirect()->route('welcome')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Session::forget('admin_id');
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
