<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request) {
        try {

            $validated = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'role_id' => 'required',
                'password' => 'required'
            
            ]);

            if($validated->fails()){
                return response()->json([
                    'message' => 'validate error',
                    'error' => $validated->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'User Created',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);


            } catch(\Throwable $th) {
                return response()->json([
                    'message' => $th->getMessage()
                ]);
            }
    }
}
