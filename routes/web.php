<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermsAndConditionController;

Route::get('/', function () {
    return view('welcome');
});
//stripe routes
Route::get('checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::post('checkout', [StripeController::class, 'stripePost'])->name('stripe.post');

Route::get('admin/register',[AdminController::class,'showRegistrationForm'])->name('admin.register.form');
Route::post('admin/register',[AdminController::class,'register'])->name('admin.register');

Route::get('admin/login',[AdminController::class,'showLoginForm'])->name('admin.login.form');
Route::post('admin/login',[AdminController::class,'login'])->name('admin.login');

Route::get('admin/forgot-password',[AdminController::class,'forgotPassForm'])->name('admin.forgot.form');
Route::post('admin/forgot-password',[AdminController::class,'forgot'])->name('admin.forgot.password');
Route::get('admin/confirm-pin',[AdminController::class,'ShowConfirmPINForm'])->name('admin.confirmPinForm');
Route::post('admin/confirm-pin',[AdminController::class,'confirmPIN'])->name('admin.confirmPIN');


Route::middleware(['admin'])->group(function () {
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');


Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
Route::get('admin/blogs',[BlogsController::class,'blogs'])->name('admin.blogs');

Route::get('admin/category',[CategoriesController::class,'category'])->name('admin.category');
Route::post('admin/category/store',[CategoriesController::class,'store'])->name('category.store');
Route::post('admin/category/update/{id}', [CategoriesController::class, 'update'])->name('category.update');
Route::post('admin/category/destroy/{id}',[CategoriesController::class,'destroy'])->name('category.destroy');

Route::get('admin/blogs',[BlogsController::class,'blogs'])->name('admin.blogs');
Route::post('admin/blog/store',[BlogsController::class,'store'])->name('blog.store');
Route::post('admin/blog/update/{id}', [BlogsController::class, 'update'])->name('blog.update');
Route::post('admin/blog/destroy/{id}',[BlogsController::class,'destroy'])->name('blog.destroy');
Route::get('/count-blogs', [AdminController::class, 'countBlogs'])->name('count.blogs');


Route::get('admin/contact-us',[ContactUsController::class,'ContactUs'])->name('admin.contactUs');
Route::put('admin/contact/update/{id}', [ContactUsController::class, 'update'])->name('contact.update');

Route::get('admin/privacy-policy',[PrivacyPolicyController::class,'PrivacyPolicy'])->name('admin.privacyPolicy');
Route::put('admin/privacy/update/{id}', [PrivacyPolicyController::class, 'update'])->name('privacy.update');

Route::get('admin/terms-and-condition',[TermsAndConditionController::class,'TermsAndCondition'])->name('admin.TermsAndCondition');
Route::put('admin/terms-condition/update/{id}', [TermsAndConditionController::class, 'update'])->name('termsAndCondition.update');

Route::get('admin/users-list',[UsersController::class,'users'])->name('show.users.list');

});
