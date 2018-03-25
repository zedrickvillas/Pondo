<?php

namespace App\Http\Controllers;
use App\Models\Post;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
    	$posts =  Post::orderBy('created_at', 'desc')->paginate(6);
        return view('index')->with('posts', $posts);
    }
}
