<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Fund;

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
        $results=array();
        foreach(Cart::content() as $row) {

                //Cart::content()->get('qty')
                    if ($row->qty <= DB::table('funds')->select('id')->where(['post_id' => $row->options['post_id'], 'status' => "Available"])->get()->count()) {
                        array_push($results,'true');



                        //return var_dump(Cart::content()->pluck('qty'));
                        //return DB::table('funds')->select('id')->where(['post_id' => 3, 'status' => "Available"])->get()->count();
                        //return view ('transaction.create')->with('data',$data);

                    } else{

                        array_push($results,'false');
                        //return back()->with('error','Not enough Stocks');
                    }


                }
                $collected_results = collect($results);
                if( $collected_results->contains('false')){
                    Cart::destroy();
                    return redirect('/')->with('error','Not enough Stocks');

                    //temporary solution

                }else{

                    //$purchase = (float) filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT);
                    //$purchase = (str_split(Cart::subtotal()));
                    //$purchase = (floatval(Cart::subtotal()));
                    //$test ="1,000.22";
                    $purchase = floatval(str_replace( ',', '', Cart::subtotal()));
                    $balance = ((double)(DB::table('wallet')->select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance')));
                    //$balance = Wallet::select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance');
                    //$balance = Wallet::all();
                    $fundsAfterPurchase = $balance - $purchase;
                    $user_id= value(auth()->user()->id);
                   $data =['purchase' => $purchase,
                        'balance' => $balance,
                        'fundsAfterPurchase' => $fundsAfterPurchase,
                        'user_id' => $user_id];

                    return view ('transaction.create')->with('data',$data);
                }




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fund =  DB::table('funds')->select('amount')->where('status','=',"Available")->count();
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
                //update
                DB::table('wallet')->where('id','=', value(auth()->user()->id))->update(['balance' => $balance - $row->price ]);


               $transaction_business = new Transaction;
               $transaction_business->amount = $row->price;
               $transaction_business->balance_before = DB::table('wallet')->select('balance')->where('user_id', '=', DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id'))->implode('balance');
               $transaction_business->balance_after = ((int)(DB::table('wallet')->select('balance')->where('user_id', '=', DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id'))->implode('balance'))) + $row->price;
               $transaction_business->type = $request->input('transaction_type');
               $transaction_business->user_id = DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id');
               $transaction_business->save();
               //update
                DB::table('wallet')->where('id','=', DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id'))->update(['balance' => ((int)(DB::table('wallet')->select('balance')->where('user_id', '=', DB::table('posts')->select('user_id')->where('id', '=', $row->id)->implode('user_id'))->implode('balance'))) + $row->price ]);

                $l = DB::table('funds')->select('id')
                    ->where(['post_id' => $row->id,
                        'status' => "Available"])->get()->first();

                //DB::table('funds')->where(['post_id' => $row->id,'status' => "Available"])->first()->update(['investor' => $user_id,'status'=>'Sold']);
                Fund::where(['post_id' => $row->id,'status' => "Available"])->first()->update(['investor' => $user_id,'status'=>'Sold']);
                }
        }
        //return var_dump($l);
        //return DB::table('wallet')->select('balance')->where('user_id','=',value(auth()->user()->id))->implode('balance');
        //return DB::table('wallet')->select('balance')->where('user_id','=',DB::table('posts')->select('user_id')->where('user_id','=',1)->implode('user_id'))->implode('balance');
        //return DB::table('posts')->select('user_id')->where('user_id','=',2)->implode('user_id');
        //return (DB::table('wallet')->select('balance')->where('user_id','=',DB::table('posts')->select('user_id')->where('user_id','=',2)->implode('user_id'))->implode('balance'));
        //return DB::table('wallet')->select('balance')->where('user_id','=',2)->implode('balance');
        //return DB::table('posts')->select('user_id')->where('id','=',$row->id)->implode('user_id');
        Cart::destroy();
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
