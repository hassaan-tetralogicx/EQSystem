<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('home');
    }
    public function show(){
        $users = User::all()->except(Auth::id());
        
        return view('admindashboard.show')->with('users', $users);
    }
}
