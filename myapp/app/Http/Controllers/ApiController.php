<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        //Response
        return response()->json([
            "status" => true,
            "message" => "User registered successfully",
        ]);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!empty($user)){
            if (Hash::check($request->input('password'), $user->password)) {
                // Passwords match, proceed with login
                $user->tokens()->delete(); // Revoke all previous tokens
                $token = $user->createToken('auth_token')->plainTextToken; // Create new token
                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    // 'data' => $user,
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function profile(Request $request){
        $user_data = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'User profile retrieved successfully',
            'data' => $user_data,
        ]);
    }

    public function logout(){
        request()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully',
        ]);
    }
}
