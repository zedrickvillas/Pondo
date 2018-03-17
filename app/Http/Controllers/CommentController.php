<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }



    public function store(Request $request) {
    	$this->validate($request, [
    		'user_id' 	=> 'required',
    		'post_id' 	=> 'required',
    		'comment' 	=> 'required|min:60|max:5000',
            'rate'      => 'required',
    	]);

        $post = Post::find($request->input('post_id'));
        $rate = $request->input('rate');
        $user_id = auth()->user()->id;

        if ($post->isRatedBy($user_id)) {
            return back()->with('error', 'You already reviewed this business!');
        }

        $post->getRatingBuilder()
                 ->user($user_id) // you may also use $user->id
                 ->uniqueRatingForUsers(true) // update if already rated
                 ->rate($rate);
     


    	Comment::create([
    		'body' 		=> $request->input('comment'),
    		'post_id' 	=> $request->input('post_id'),
    		'user_id' 	=> $request->input('user_id'),
    	]);

    	return back()->with('success', 'Successfully rated.');
    }

    public function destroy($id) {
    	$comment = Comment::find($id);
        $post_id = $comment->post->id;
        $post = Post::find($post_id);

    	if (auth()->user()->id !== $comment->user_id) {
    		return back()->with('error', 'Unauthorized action');
    	}

        $post->deleteRatingsForUser($comment->user_id);

    	$comment->delete();
    	return back()->with('success', 'Comment has been successfully deleted.');
    }
}
