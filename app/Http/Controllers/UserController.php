<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Business;

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
        $business = User::find($user->id)->business;

        if ($user->isAdmin()) {
            return view('pages.admin.dashboard');
        } if ($user->hasRole('business.owner')) {
            //return $business;
            return view('pages.businessowner.dashboard',compact('business'))->with('posts',$user->posts);
            //return view('pages.businessowner.dashboard') ->with('posts',$user->posts,'business',$business);
        } else {
            return view('pages.investor.dashboard');
        }
        

    }
}
