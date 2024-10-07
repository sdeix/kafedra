<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Login failed'], 403);
        }
        
        $token = str_replace('Bearer ', '', $token);

        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Login failed'], 403);
        }
        return $next($request);
    }
}