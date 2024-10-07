<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminRole
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
      
        $token = str_replace('Bearer ', '', $token);
        $user = User::where('token', $token)->first();

        if($user->role=='admin'){
            return $next($request);
        }
        return response()->json(['error' => 'Forbidden for you'], 403);
    }
}