<?php

namespace App\Http\Controllers;

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

            $business = User::find($user->id)->business;
            $posts = Post::where('user_id', $user->id)->paginate(5);

            $funds = Fund::where('business_owner',value(auth()->user()->id))->paginate(50);
            $sold =  Fund::where(['business_owner'=>value(auth()->user()->id),'status'=>"Sold"])->paginate(20);
            $completed =  Fund::where(['business_owner'=>value(auth()->user()->id),'status'=>"Completed"])->paginate(20);
            $data = ['posts' => $posts ,
                            'business' => $business ,
                            'funds' => $funds,
                            'sold'=>$sold,
                            'completed'=>$completed];



            //return $funds->pluck('id');

            return view('pages.businessowner.dashboard') ->with('data',$data);
        

        } else {

            $funds = Fund::where('investor',value(auth()->user()->id))->paginate(20);
            $sold =  Fund::where(['investor'=>value(auth()->user()->id),'status'=>"Sold"])->paginate(20);
            $completed =  Fund::where(['investor'=>value(auth()->user()->id),'status'=>"Completed"])->paginate(20);
            $failed =  Fund::where(['investor'=>value(auth()->user()->id),'status'=>"Failed"])->paginate(20);
            $data = ['funds' => $funds ,
                    'sold' => $sold ,
                    'completed' => $completed,
                    'failed' => $failed];

            return view('pages.investor.dashboard')->with('data',$data);
        }
        

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
