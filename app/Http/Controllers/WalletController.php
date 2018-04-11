<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use DB;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * DB::table('users')->select('name', 'email as user_email')->get()
     * DB::table('wallet')->select('user_id')->where('user_id',=,1)->get()
     * DB::table('wallet')->select('user_id')->where('user_id','=',auth()->user()->id)->get()
     * $balance = $query->row()->balance;
     * $results = DB::select('select * from users where id = :id', ['id' => 1]);
     * DB::table('users')->where('username', $username)->pluck('groupName');
     */
    public function index()
    {
        $a = value(auth()->user()->id);
        $b = DB::table('wallet')->select('user_id')->where('user_id','=',$a)->pluck('user_id');

        if($b->contains($a)) {
            //

        }else{
            DB::table('wallet')->insert([
                'balance' => value(0),
                'user_id' => value(auth()->user()->id),
            ]);
        }

        $bal = DB::table('wallet')->select('balance')->where('user_id','=',$a)->implode('balance');


        return view('wallet.index')->with('balance',$bal);
    }
    public function create()
    {
        return view('wallet.create');
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
            'denomination'             => 'required',
        ]);



        $wallet = Wallet::find(value(auth()->user()->id));
        $denomination = $request->input('denomination');

        DB::table('wallet')->where('user_id',value(auth()->user()->id))->update([
            'balance' => value((DB::table('wallet')
                ->select('balance')
                ->where('user_id','=',value(auth()->user()->id))->implode('balance'))+$denomination),
        ]);


        return redirect()->route('home')->with('success', 'Funds Added');
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

        $this->validate($request, [
            'denomination'             => 'required',
        ]);
        $wallet = Wallet::find(value(auth()->user()->id));
        $denomination = $request->input('denomination');

        $wallet->balance = ($wallet->balance) + $denomination;

        $wallet->save();


        return redirect()->route('wallet')->with('success', 'Post Created');
    }

    /**
     * Remove the specified resource from storage.
     *        DB::table('wallet')->where('user_id',value(auth()->user()->id))->update([
    'balance' => value((DB::table('wallet')
    ->select('user_id')
    ->where('user_id','=',value(auth()->user()->id))->pluck('balance'))+$denomination),
    ]);
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
