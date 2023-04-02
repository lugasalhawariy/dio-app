<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->user()->tokens()->updateOrCreate(
                [
                    'name' => $request->user()->name,
                ],
                [
                    'token' => hash('sha256', $request->user()->email . $request->user()->password . time()),
                    'expires_at' => now()->addMinutes(60*5),
                ]
            );

            return JsonResponse::success(
                $request->user()->tokens()->latest()->first()->token,
                'User logged in',
                200
            );
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
