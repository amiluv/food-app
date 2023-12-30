<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthManager extends Controller
{
    function login()
    {
        return view("login");
    }
    function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("dashboard"))->with("success", "Welcome");
        }
        return redirect()->intended(route("login"))->with("error", "login failed");
    }
    function logout()
    {
        session_abort();
        Auth::logout();
        return redirect()->intended(route("login"))->with("success", "Login again to continue");
    }
}