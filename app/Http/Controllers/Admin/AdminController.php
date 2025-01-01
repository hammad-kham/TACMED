<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PasswordResetRequest;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('backend.dashboard');
    }

    // public function countBlogs(){
    //     $count_blogs = Collection::count();
    //     $count_category = Category::count();
    //     return view('backend.layouts.aside',compact('count_blogs','count_category'));
    // }

    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        return view('backend.AdminAuth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/login')->with('error', 'login failed');
        }

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect('/admin/login')->with('error', 'Credentials Incorrect.');
        }
        // Attempt to log in with the provided credentials
        if (Auth::guard('admin')->attempt(['email' => $admin->email, 'password' => $request->password])) {
            return redirect('/admin/dashboard');
        }
        return redirect('/admin/login')->with('error', 'invalid credentials');
    }

    public function showRegistrationForm()
    {

        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        return view('backend.AdminAuth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string|max:255",
            'email' => "required|string|email|unique:admins",
            'password' => "required|string|confirmed|min:8",
        ]);

        if ($validator->fails()) {
            return redirect('/admin/register')->with('error', $validator->errors());
        }
        //create admin if validate is true
        Admin::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),

        ]);
        return redirect('/admin/login')->with('success', 'Accoubt Created Successfully.');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }


    //X------------X--------x



}
