<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // GUEST
    public function welcome2(){
        return view('guest.welcome2');
    }
    public function about(){
        return view('guest.about');
    
    }
     // AUTHENTICATED
    public function dashboard(){
        return view('dashboard');
    }
    public function userlist(){
        $users = User::all();
        return view('admin.user-list',compact('users'));
    }
    
   
    
}