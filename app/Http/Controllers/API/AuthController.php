<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        // $token = $user->createToken('auth_token')->plainTextToken;
        $token = JWTAuth::fromUser($user);

        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer'], 201);
    }

    public function login(Request $request)
    {
       
        $credentials = $request->only('email', 'password');

        // if (!$token = JWTAuth::attempt($credentials)) {
        //     Log::info($token);
        //     return response()->json(['error' => 'Invalid credentials'], 401);
        // }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = JWTAuth::fromUser($user, ['role' => $user->role]);

        return response()
            ->json(['success' => true, 'access_token' => $token, 'token_type' => 'Bearer', 'role' => $user->role, 'id' => $user->id]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            Log::info( $e->getMessage());
            return response()->json(['error' => 'Something went wrong, please try again.'], 500);
        }

    }

}
