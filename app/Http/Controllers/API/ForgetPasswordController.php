<?php

namespace App\Http\Controllers\API;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;

class ForgetPasswordController extends Controller
{
    //the password reset is done in three steps
    //step1: request  email, generate pin and send it to mail
    //step2: validate pin and email and expiry
    //step3: change password, update user and delete pin, and notify user with success mail

    //step1:
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User with this email does not exist.',
            ], 404);
        }
        try {
            $pin = mt_rand(1000, 9999);
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $user->email],//to this user
                ['email' => $user->email, 'pin' => $pin,] //update this
            );
            // $user->notify(new PasswordResetRequest($pin));
            
            if ($user && $passwordReset)
                $user->notify(
                    new PasswordResetRequest($passwordReset->pin)
                );

            return response()->json([
                'status' => 'success',
                'message' => 'Code has been sent to your email.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to process request. Try again later.',
            ], 500);
        }
    }
    //X-----------X-------X
    //step2
    public function ConfirmPIN(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'pin' => 'required|integer|min:4'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        //get record from PasswordReset model by email coming in request
        $passwordReset = PasswordReset::where('email', $request->email)->first();
        // dd($passwordReset);
        if (!$passwordReset || $request->pin !== $passwordReset->pin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid pin.',
            ], 404);
        }

        // Check if the PIN is expired (e.g., 15 minutes expiration)
        if (Carbon::parse($passwordReset->created_at)->addMinutes(15)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'status' => 'error',
                'message' => 'This password reset token has expired.',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Code verified successfully.',
        ], 200);
    }
    //X-------------X----------X
    //step3
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|string|confirmed|min:8',
            'pin' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        //get user email from PasswordReset model
        $passwordReset = PasswordReset::where('email', $request->email)->first();

        //check if pin and email are correct if not through error
        if (!$passwordReset || $request->pin !== $passwordReset->pin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials or pin.',
            ], 404);
        }
        //Retrieve the User
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials or token.',
            ], 404);
        }

        // Update user's password and save it
        $user->password = $request->password;
        $user->save();
        // Delete the password reset record after successful reset
        $passwordReset->delete();
        // Send password reset success notification to the user
        $user->notify(new PasswordResetSuccess());

        return response()->json([
            'status' => 'success',
            'message' => 'Password has been reset successfully.',
        ], 200);
    }
}
