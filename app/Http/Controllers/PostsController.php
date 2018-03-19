<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Image;
use File;
use Auth;
use Mail;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function __construct()
    {
        $this->middleware('auth', ['except' =>['index','show']]);
    }


    /**]  * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'             => 'required',
            'body'              => 'required',
            'quantity'          => 'required|numeric',
            'price'             => 'required|numeric',
            'featured_image'    => 'required',
        ]);



        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->quantity = $request->input('quantity');
        $post->price = $request->input('price');
        $post->user_id = auth()->user()->id;

        // Save Image
        if ($request->hasFile('featured_image')) {
            $image  = $request->file('featured_image');
            $file_name =  time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/images/users/id/' . $post->user_id . '/uploads/posts/';

            // Make the user a folder and set permissions

            if (!file_exists($location)) {
                mkdir($location, 666, true);
            }


            Image::make($image)->save($location.$file_name);

            $post->image = '/images/users/id/' . $post->user_id . '/uploads/posts/'. $file_name;
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !==$post->user_id){
            return redirect()->route('home')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'quantity' => 'required',
            'update_msg' => 'required',
            'price' => 'required',
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->quantity = $request->input('quantity');
        $post->price = $request->input('price');
        //$post->user_id = auth()->user()->id;
        $post->save();

        if ($post->followersCount() > 0) {
            $followers_emails = $post->followersEmails();
            $title = $post->title.':';
            $content = $request->input('update_msg');

            Mail::send('emails.send', ['title' => $title, 'content' => $content], function($message) use($followers_emails) {

                $message->from($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
                $message->to($followers_emails)->subject('My Pondo Subscription| An invesment has been updated');
                
            });
        }

        

        return redirect()->route('home')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !==$post->user_id){
            return redirect()->route('home')->with('error', 'Unauthorized Page');
        }
        $post->delete();
        return redirect()->route('home')->with('success', 'Post Removed');
    }


    public function favoritePost(Post $post) {
        Auth::user()->favorites()->attach($post->id);

        return back();
    }

    public function unFavoritePost(Post $post) {
        Auth::user()->favorites()->detach($post->id);
    }

}
