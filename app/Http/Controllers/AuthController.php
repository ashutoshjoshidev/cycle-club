<?php

namespace App\Http\Controllers;

use App\Events\UserRegisterEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|same:confirm-password|min:8|max:12',
            'ride_type' =>'required|exists:cycling_clubs,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            event(new UserRegisterEvent($user,$request->ride_type));
            return response()->json($user, 201);
        } else {
            return response()->json('Something went wrong on the server.', 400);
        }
    }
}
