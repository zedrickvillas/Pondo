<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $user_id= value(auth()->user()->id);
        $data =['purchase' => $purchase,
                'balance' => $balance,
                'fundsAfterPurchase' => $fundsAfterPurchase,
                'user_id' => $user_id];
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
        $balance = DB::table('wallet')->select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance');
        $user_id= value(auth()->user()->id);
        //$balance_business =  DB::table('posts')->select('user_id')->where('user_id','=',$row->id)->implode('user_id');
        //DB::table('wallet')->select('balance')->where('user_id','=',DB::table('posts')->select('user_id')->where('user_id','=',$row->id))->implode('balance');
        foreach(Cart::content() as $row){
            for ($x = 1; $x <= $row->qty; $x++) {

                $transaction_investor = new Transaction;
                $transaction_investor->amount = $row->price;
                $transaction_investor->balance_before = $balance;
                $transaction_investor->balance_after = $balance - $row->price;
                $transaction_investor->type = $request->input('transaction_type');
                $transaction_investor->user_id = $user_id;
                $transaction_investor->save();




               $transaction_business = new Transaction;
               $transaction_business->amount = $row->price;
               $transaction_business->balance_before = DB::table('wallet')->select('balance')->where('user_id', '=', DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id'))->implode('balance');
               $transaction_business->balance_after = ((int)(DB::table('wallet')->select('balance')->where('user_id', '=', DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id'))->implode('balance'))) + $row->price;
               $transaction_business->type = $request->input('transaction_type');
               $transaction_business->user_id = DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id');
               $transaction_business->save();

                $p = DB::table('posts')->select('user_id')->where('user_id', '=', $row->id)->implode('user_id');
                }
        }
        //return DB::table('wallet')->select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance');
        //return DB::table('wallet')->select('balance')->where('user_id','=',DB::table('posts')->select('user_id')->where('user_id','=',1)->implode('user_id'))->implode('balance');
        //return DB::table('posts')->select('user_id')->where('user_id','=',2)->implode('user_id');
        //return (DB::table('wallet')->select('balance')->where('user_id','=',DB::table('posts')->select('user_id')->where('user_id','=',2)->implode('user_id'))->implode('balance'));
        //return DB::table('wallet')->select('balance')->where('user_id','=',2)->implode('balance');
        //return DB::table('posts')->select('user_id')->where('id','=',$row->id)->implode('user_id');
        return redirect()->route('home')->with('success', 'Transaction Successful');


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
