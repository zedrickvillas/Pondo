<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fund;
use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Business;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

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

        Cart::restore((value(auth()->user()->id)));

        if ($user->isAdmin()) {

            return view('pages.admin.dashboard');

        } if ($user->hasRole('business.owner')) {

            $posts = Post::where('user_id', $user->id)->paginate(5);
            $data = ['posts' => $posts];
            return view('pages.businessowner.dashboard') ->with($data);

        } else {

            $funds = Fund::where('investor',value(auth()->user()->id))->paginate(10);
            $sold =  Fund::where(['investor'=>value(auth()->user()->id),'status'=>"Sold"])->paginate(10);
            $completed =  Fund::where(['investor'=>value(auth()->user()->id),'status'=>"Completed"])->paginate(10);
            $failed =  Fund::where(['investor'=>value(auth()->user()->id),'status'=>"Failed"])->paginate(10);
            $data = ['funds' => $funds ,
                    'sold' => $sold ,
                    'completed' => $completed,
                    'failed' => $failed,
            ];

            return view('pages.investor.dashboard')->with($data);
        }
        
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_id = $request->input('post_id');
        return view('pages.businessowner.business.fund')->with('post',$post_id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        //
    }

    public function myFavorites() { 

        $data = [
            'myFavorites' => Auth::user()->favorites,
        ];

        if (Auth::user()->hasRole('investor')) {
            return view('pages.investor.my_favorites')->with($data);
        } else {
            return back()->with('error', 'Unauthorized Access');
        }
        
    }


}
