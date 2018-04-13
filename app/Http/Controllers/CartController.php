<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use DB;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isInvestor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = value(auth()->user()->id);
        $b = DB::table('shoppingcart')->select('identifier')->where('identifier','=',$a)->pluck('identifier');
        if (auth()->user()->hasRole('investor')) {

            //if($b->contains($a)) {
            // //   Cart::restore((value(auth()->user()->id)));
//
            //}else{
            //    Cart::store((value(auth()->user()->id)));
            //}


            return view('pages/investor/cart');
        } else {

            return back()->with('error', 'Unauthorized access');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //Cart::add($request->id, $request->title, 1, $request->price,['user_id' => $request->user_id])->associate('App\Models\Post');
        Cart::add(['id' => $request->id, 'name' => $request->title, 'qty' => $request->quantity, 'price' => $request->price, 'options' => ['user_id' => $request->user_id,'post_id'=>$request->id]])->associate('App\Models\Post');

        return back()->with('success','Item has been added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success', 'Item has been removed!');
    }
}
