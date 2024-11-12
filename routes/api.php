<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OnboardingController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ForgetPasswordController;
use App\Http\Controllers\API\UpdatePasswordController;
use App\Http\Controllers\API\UserProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
//get onboarding pages route
Route::get('getAllPages',[OnboardingController::class,'getAllPages']);
//auth routes
Route::post('register',[AuthenticationController::class,'register']);
Route::post('login',[AuthenticationController::class,'login']);
Route::post('logout',[AuthenticationController::class,'logout']);

//forget password routes
Route::post('forget-password',[ForgetPasswordController::class,'ForgetPassword']);
Route::post('confirm-pin',[ForgetPasswordController::class,'ConfirmPIN']);
Route::post('reset-password',[ForgetPasswordController::class,'resetPassword']);

//profile routes 
Route::get('contact-us',[ContactController::class,'ContactUs']);
//user profile routes
Route::get('profile',[UserProfileController::class,'Profile']); 
//change password route
Route::post('update-password',[UpdatePasswordController::class,'UpdatePassword']); 

