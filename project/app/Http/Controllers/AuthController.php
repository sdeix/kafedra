<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'fio' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->fio = $request->input('fio');
        $user->save();
        $token = $user->createToken();
        return response()->json(['user_token' => $token], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Неправильный логин или пароль'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('token');

        return response()->json(['user_token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
    
        if ($token) {
            $user = User::where('token', $token)->first();
    
            if ($user) {
                $user->update(['token' => null]);
            }
        }
    
        return response()->json(['message' => 'Выход выполнен успешно'], 200);
    }

}