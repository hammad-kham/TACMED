<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'validatorerror' => '1',
            ], 422);
        }

        //Convert Password into hash
        $input['password'] = bcrypt($input['password']);
        //create new user now
        $user = User::create($input);
        //create token
        $api_token = $user->createToken($user->email)->accessToken;
        //upadet the api token in the database of user.
        User::where('id', $user->id)->update(['api_token' => $api_token]);
        if ($user) {
            return response()->json([
                "userdata" => $user,
                "message" => "User Registered Successfully",
                "status" => 'success',
                'validaterror' => "0"
            ], 200);
        }
    }
    //X---------X---------------X
    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => "required|string|email",
            'password' => 'required|string|min:8',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        // Attempt to authenticate the user
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Authentication was successful; retrieve the authenticated user
        $user = Auth::user();
        // Generate an access token for the authenticated user
        $token = $user->createToken($user->email)->accessToken;

        // Return a success response with user data and token
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => $user,
        ], 200);
    }

    
}
