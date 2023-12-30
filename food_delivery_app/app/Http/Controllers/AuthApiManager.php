<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiManager extends Controller
{
    function login(Request $request)
    {
        if (empty($request->email) && empty($request->password)) {
            return array("status" => "failes", "message" => "All fields are required");
        }
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return array("status" => "Failed", "message" => "Invalid credentials");
        }
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return array("status" => "Success", "message" => "Welcome, $user->name");
        }
        return array("status" => "Failed", "message" => "Invalid credentials");
    }

    function registration(Request $request)
    {
        if (empty($request->name) && empty($request->email) && empty($request->password)) {
            return array("status" => "failed", "message" => "All fields are required");
        }
        $user = User::create([
            "type" => "customer",
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        if (!$user) {
            return array("status" => "failed", "message" => "Registration failed");
        }
        return array("status" => "Successful", "message" => "Login to proceed");
    }
}