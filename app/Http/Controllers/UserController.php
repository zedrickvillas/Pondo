<?php

namespace App\Http\Controllers;

use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('pages.admin.dashboard');
        } if ($user->hasRole('business.owner')) {
            return view('pages.businessowner.dashboard');
        } else {
            return view('pages.investor.dashboard');
        }
        
        
    }
}
