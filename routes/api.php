<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OnboardingController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ForgetPasswordController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\UpdatePasswordController;
use App\Http\Controllers\API\UserProfileController;
use App\Http\Controllers\API\UserSettingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


//open routes
//get onboarding pages route
Route::get('getAllPages',[OnboardingController::class,'getAllPages']);
//auth routes
Route::post('register',[AuthenticationController::class,'register']);
Route::post('login',[AuthenticationController::class,'login']);


//forget password routes
Route::post('forget-password',[ForgetPasswordController::class,'ForgetPassword']);
Route::post('confirm-pin',[ForgetPasswordController::class,'ConfirmPIN']);
Route::post('reset-password',[ForgetPasswordController::class,'resetPassword']);

//authenticated routes
Route::middleware('auth:api')->group(function(){
//home page routes
Route::get('home-page',[HomeController::class,'homePage']);
Route::get('all-categories',[HomeController::class,'allCategories']);
Route::get('all-collections',[HomeController::class,'allCollections']);
Route::get('show-collection/{id}', [HomeController::class, 'showCollection']);
Route::get('show-category/{id}', [HomeController::class, 'showCategory']);


//profile routes 
Route::get('contact-us',[ContactController::class,'ContactUs']);
//user profile routes
Route::get('profile',[UserProfileController::class,'Profile']); 
//change password route
Route::post('update-password',[UpdatePasswordController::class,'UpdatePassword']); 

//user setting routes
Route::get('get-policy',[UserSettingController::class,'getPrivacyPolicy']); 
Route::get('get-terms-conditions',[UserSettingController::class,'getTermsConditions']); 
Route::post('/notification-control', [UserSettingController::class, 'toggleNotification']);
Route::post('delete-account',[UserSettingController::class,'deleteAccount']); 
Route::post('logout',[UserSettingController::class,'logout']);

});
