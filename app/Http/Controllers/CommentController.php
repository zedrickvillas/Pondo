<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }


    public function store(Request $request) {
    	$this->validate($request, [
    		'user_id' 	=> 'required',
    		'post_id' 	=> 'required',
    		'comment' 		=> 'required|min:60|max:5000',
    	]);

    	Comment::create([
    		'body' 		=> $request->input('comment'),
    		'post_id' 	=> $request->input('post_id'),
    		'user_id' 	=> $request->input('user_id'),
    	]);

    	return back();
    }

    public function destroy($id) {
    	$comment = Comment::find($id);

    	if (auth()->user()->id !== $comment->user_id) {
    		return back()->with('error', 'Unauthorized action');
    	}
    	$comment->delete();
    	return back()->with('success', 'Comment has been successfully deleted.');
    }
}
