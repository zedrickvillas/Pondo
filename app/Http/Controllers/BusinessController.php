<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        return view('pages.businessowner.business.show')->with('business', $business);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        /*

            if (auth()->user()->business != $business) {
                return redirect(route('welcome'))->with('error', 'Unauthorized access');
            }

        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        //
    }

    public function rate(Request $request)
    {

        $business = Business::find($request->input('business_id'));
        $rate = $request->input('rate');
        $user_id = auth()->user()->id;

        if ($business->isRatedBy($user_id)) {
            return redirect(route('business.show', ['business' => $business]))->with('error', 'You already rated this business!');
        }
        
        $business->getRatingBuilder()
                 ->user($user_id) // you may also use $user->id
                 ->uniqueRatingForUsers(true) // update if already rated
                 ->rate($rate);
     
        return redirect(route('business.show', ['business' => $business]))->with('success', 'Successfully rated.');

    }

}
