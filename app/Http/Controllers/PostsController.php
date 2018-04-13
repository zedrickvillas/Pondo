<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image as GalleryImage;
use App\Models\Fund;
use App\Models\User;
use App\Models\Transaction;
use DB;
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
        $this->middleware('auth', ['except' =>['index','show','search']]);
        $this->middleware('isInvestor', ['only' =>['favoritePost', 'unFavoritePost']]);
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
            'roi'               => 'required|numeric',
            'featured_image'    => 'required',
        ]);



        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->quantity = $request->input('quantity');
        $post->price = $request->input('price');
        $post->roi = $request->input('roi');
        $post->user_id = auth()->user()->id;
        $post->return_date = $request->input('return_date');

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


        //create funds based on post
        for ($x = 1; $x <= $post->quantity; $x++) {
            $fund = new Fund;
            $fund->post_id = $post->id;
            $fund->business_owner = $post->user_id;
            $fund->investor = " ";
            $fund->amount = $post->price;
            $fund->status = "Available";
            $fund->return_date = $post->return_date;
            $fund->save();
        }

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
        $fund =  DB::table('funds')->select('id')->where(['post_id' => $post->id,'status' => "Available"])->get()->count();

        $post = Post::find($id);
        $data = ['post' => $post,
                 'fund' => $fund];
        return view('posts.show')->with($data);
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
            'body'              => 'required',
            'featured_image'    => 'image',
            'update_msg'        => 'sometimes',
        ]);

        $post = Post::find($id);
        $post->body = $request->input('body');

        if ($request->featured_image) {
            // add new featured image
            $image  = $request->file('featured_image');
            $file_name =  time() . '.' . $image->getClientOriginalExtension();
            $location = public_path() . '/images/users/id/' . $post->user_id . '/uploads/posts/';

            // Make the user a folder if nonexistent and set permissions
            if (!file_exists($location)) {
                mkdir($location, 666, true);
            }

            Image::make($image)->save($location.$file_name);

            if ( !empty($post->image)) {
                // delete the old image from directory
                $oldFileName =  public_path() . $post->image;
                File::delete($oldFileName);
            }
            

            // update the database
            $post->image = '/images/users/id/' . $post->user_id . '/uploads/posts/'. $file_name;


        }



        $post->save();

        if ($request->input('update_msg') !== null ) {
            if ($post->followersCount() > 0) {
                $followers_emails = $post->followersEmails();
                $title = $post->title.':';
                $content = $request->input('update_msg');

                Mail::send('emails.send', ['title' => $title, 'content' => $content], function($message) use($followers_emails) {

                    $message->from($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
                    $message->to($followers_emails)->subject('My Pondo Subscription| An investment has been updated');
                    
                });
            }
        }


        return redirect()->route('posts.show', ['post' => $post->id])->with('success', 'Post Updated');
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
    }

    public function unFavoritePost(Post $post) {
        Auth::user()->favorites()->detach($post->id);
    }

    public function galleryIndex(Post $post) {
        return view('posts.gallery')->with('post', $post);
    }

    public function galleryUpload(Request $request) {

        $post_id = $request->input('post_id');
        $post = Post::find($post_id);

        // get file from the post request
        $image = $request->file('file');

        // set file name
        $file_name = uniqid() . '.' . $image->getClientOriginalExtension();

        

        $location = public_path() . '/images/users/id/' . $post->user_id . '/uploads/posts/gallery/';

        // Make the user a folder if nonexistent and set permissions
        if (!file_exists($location)) {
            mkdir($location, 755, true);
        }

        Image::make($image)->save($location.$file_name);
            
        // save tinto he database
        $file_path = '/images/users/id/' . $post->user_id . '/uploads/posts/gallery/'. $file_name;

        $image = $post->images()->create([
            'post_id'   => $post_id,
            'image'     => $file_path,
        ]);

        return $image;

    }


    public function galleryDelete($id)
    {
        $image = GalleryImage::find($id);

        // Delete Image from directory
        unlink(public_path($image->image));

        // Delete image from database
        $image->delete();
        
        return back();
    }

    public function search(Request $request) {
        $search = $request->input('search');

        $posts = Post::orderBy('created_at', 'desc')->where('title', 'LIKE', '%'.$search.'%')->orWhere('body', 'LIKE', '%'.$search.'%')->paginate(6);

        return view('index')->with('posts', $posts);
    } 


    public function transactions($id) {

        $user = Auth::user();

        if ($user->hasRole('business.owner')) {
            $post = Post::find($id);

            $funds = Fund::where('post_id', $post->id)->paginate(10);
            $sold =  Fund::where(['post_id'=> $post->id,'status'=>"Sold"])->get();
            $completed =  Fund::where(['post_id'=> $post->id,'status'=>"Completed"])->get();

            $data = ['post' => $post,
                     'funds' => $funds,
                     'sold'=>$sold,
                     'completed'=>$completed
                    ];

        }

        return view('pages.businessowner.transactions')->with($data);
    }  

    public function investment($id) {
        $post = Post::find($id);
        $sold = Fund::where(['status'=>'Sold','post_id'=>$post->id])->paginate(5);
        $data = ['post' => $post ,
            'sold' => $sold,
        ];
        return view('pages.businessowner.business.fund')->with($data);
    }


    public function total_investment (Request $request){

        $balance = DB::table('wallet')->select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance');
        $amount_return_investment = $request->input('cost_return_investment');
        $quantity = $sold = Fund::where(['status'=>'Sold','post_id'=>$request->input('post_id')])->count();
        $purchase = $amount_return_investment * $quantity ;
        $fundsAfterPurchase = $balance - $purchase;
        $post_id = $request->input('post_id');
        $data = ['balance' => $balance,
                'purchase' => $purchase,
                'fundsAfterPurchase' => $fundsAfterPurchase,
                'quantity' => $quantity,
                'amount_return_investment' => $amount_return_investment,
                'post_id' => $post_id,

        ];

        return view('pages.businessowner.business.total_request')->with('data',$data);
    }

    public function request_investment_return (Request $request){
        $sold = Fund::where(['status'=>'Sold','post_id'=>$request->input('post_id')])->get();


        foreach($sold as $row){

                $transaction_investor = new Transaction;
                $transaction_investor->amount = $row->amount;
                $transaction_investor->balance_before = DB::table('wallet')->select('balance')->where('user_id', '=', $row->investor)->implode('balance');
                $transaction_investor->balance_after = ((int)(DB::table('wallet')->select('balance')->where('user_id', '=', $row->investor)->implode('balance'))) + $row->amount;
                $transaction_investor->type = $request->input('transaction_type');
                $transaction_investor->user_id =  $row->investor;
                $transaction_investor->save();
                //update
                DB::table('wallet')->where('user_id','=', $row->investor)->update(['balance' => ((int)( DB::table('wallet')->select('balance')->where('user_id', '=', $row->investor)->implode('balance'))) + $row->amount ]);


                $transaction_business = new Transaction;
                $transaction_business->amount = $row->amount;
                $transaction_business->balance_before = DB::table('wallet')->select('balance')->where('user_id', '=', value(auth()->user()->id))->implode('balance');
                $transaction_business->balance_after = ((int)DB::table('wallet')->select('balance')->where('user_id', '=', value(auth()->user()->id))->implode('balance')) - $row->amount;
                $transaction_business->type = $request->input('transaction_type');
                $transaction_business->user_id = value(auth()->user()->id);
                $transaction_business->save();
                //update
                DB::table('wallet')->where('user_id','=', value(auth()->user()->id))->update(['balance' => ((int)DB::table('wallet')->select('balance')->where('user_id', '=', value(auth()->user()->id))->implode('balance')) - $row->amount]);

                //$l = DB::table('funds')->select('id')
                //    ->where(['post_id' => $row->id,
                //        'status' => "Available"])->get()->first();    //
                Fund::where(['post_id' =>$request->input('post_id'),'status' => "Sold",'investor'=>$row->investor])->first()->update(['status'=>'Completed']);

                //DB::table('funds')->where(['post_id' => $request->input('post_id'),'status' => "Sold",'investor'=>$row->investor])->first()->update(['status' => 'Completed']);
                //Fund::where(['post_id' => $row->id,'status' => "Available"])->first()->update(['investor' => $user_id,'status'=>'Sold']);

        }
        //return DB::table('wallet')->where('id','=', $row->investor)->update(['balance' => ((int)(DB::table('wallet')->select('balance')->where('user_id', '=', $row->investor))) + $row->amount ]);
        return redirect()->route('home')->with('success', 'Transaction Successful');
    
    }



}

    
