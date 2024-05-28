<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'code'  => 400,
                'message' => 'Validation Error',
                'error' => $validator->errors(),
            ], 422);
        }

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            // Return response JSON user is created
            return response()->json([
                'code' => 201,
                'message' => 'Registration Successful',
                'data' => [
                    'user' => $user
                ]
            ], 201);
        } catch (\Exception $e) {
            // Handle any errors that may have occurred
            return response()->json([
                'code' => 500,
                'message' => 'Registration Failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
