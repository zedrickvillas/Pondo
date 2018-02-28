<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;

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
        $user_id = auth()->user('id');
        $user1 = User::find($user_id);

        if ($user->isAdmin()) {
            return view('pages.admin.dashboard');
        } if ($user->hasRole('business.owner')) {
            return view('pages.businessowner.dashboard') ->with('posts',$user->posts);
        } else {
            return view('pages.investor.dashboard');
        }
        
        
    }
}
