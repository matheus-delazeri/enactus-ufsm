<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasRoles;
    public function login(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'user' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin')->with('success', "Successfully logged in!");
        }

        return back()->withErrors(['msg' => "Invalid credentials!"]);
    }

    public function logout() : RedirectResponse
    {
       Auth::logout();
       return redirect()->route('admin.login')->with('success', "Successfully logout!");
    }
}
