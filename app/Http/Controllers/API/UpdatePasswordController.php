<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    public function UpdatePassword(Request $request)
    {
        $user = auth('api')->user();
        // dd($user);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
        //if user is found validate the incoming data
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                // Unprocessable Entity for validation errors
            ], 422);
        }

        //Hash::check() verifies if a given plain-text password matches the hashed password stored in the database.
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->old_password == $request->password) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'your new password cannot be your old password',
                ], 400);
                //bad request
            }
            // Hash the new password and update it in the database
            $user->fill(['password' => Hash::make($request->password)])->save();
            return response()->json([
                'message' => 'Password updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Your old password was incorrect',
            ], 401);
        }
    }
}
