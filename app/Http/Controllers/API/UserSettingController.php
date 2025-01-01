<?php

namespace App\Http\Controllers\API;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Models\TermsAndConditions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function getPrivacyPolicy()
    {
        $policy = Policy::first();
        // Check if the policy was found
        if (!$policy) {
            return response()->json([
                'status' => 'error',
                'message' => 'Privacy policy not found.'
            ], 404);
        }
        return response()->json([
            'data' => $policy,
            'message' => 'privacy policy retrieved successfully.',
            'status' => 'success',

        ]);
    }

    public function getTermsConditions()
    {
        $data = TermsAndConditions::first();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'terms and conditions not found.'
            ], 404);
        }
        return response()->json([
            'data' => $data,
            'message' => 'terms and conditions retrieved successfully.',
            'status' => 'success',

        ]);
    }

    //X-------------X----------X
    public function toggleNotification(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth('api')->user();
        // Validate the input
        $validatedData = $request->validate([
            'notifications_enabled' => 'required|boolean'
        ]);
        // Update the user's notification preference
        $user->notifications_enabled = $validatedData['notifications_enabled'];
        $user->save();

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Notification settings updated successfully.',
            'data' => [
                'notifications_enabled' => $user->notifications_enabled
            ]
        ], 200);
    }




    public function deleteAccount()
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'user not found',
            ], 404);
        }

        //delete the user
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Your account has been deleted successfully.',
        ], 201);
    }

    //X------------X------------X
    public function logout(Request $request)
    {
        // Check if the user is authenticated using Auth facade
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not authenticated'
            ], 401);
        }
        // Revoke access token
        $user->token()->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully'
        ], 200);
    }
}
