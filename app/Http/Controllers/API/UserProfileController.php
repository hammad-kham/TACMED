<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function Profile(Request $request)
    {
        // Retrieve the authenticated user
        // $user = Auth::user();
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 401);
        }

        return response()->json([
            // 'user data'=>$user,
            'status' => 'success',
            'data' => $user
        ], 200);
    }
}
