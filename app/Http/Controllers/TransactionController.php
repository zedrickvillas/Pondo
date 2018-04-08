<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase = Cart::subtotal();
        $balance = DB::table('wallet')->select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance');
        $fundsAfterPurchase = $balance - $purchase;
        $data =['purchase' => $purchase,
                'balance' => $balance,
                'fundsAfterPurchase' => $fundsAfterPurchase];
        return view ('transaction.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->quantity = $request->input('quantity');
        $post->price = $request->input('price');
        $post->roi = $request->input('roi');
        $post->user_id = auth()->user()->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
