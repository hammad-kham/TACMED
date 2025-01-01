<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function users(){
        $users = User::all();
        return view('backend.userspage',compact('users'));
    }
}
