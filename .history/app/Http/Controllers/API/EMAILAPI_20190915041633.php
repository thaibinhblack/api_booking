<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
class EMAILAPI extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $input = $request->all();
        Mail::send('Email', array(
            'NAME_BOOKING' => $request->get('NAME_BOOKING'),
            'PHONE_BOOKING' => $request->get('PHONE_BOOKING'),
            'TIME_BOOK'=> $request->get('TIME_BOOK'),
            'DATE_BOOK' => $request->get("DATE_BOOK"),
            'CREATED_AT' => $request->get('CREATED_AT')
        ), function($message){
	        $message->to(
                'thaibinhblack@gmail.com', 'Thông báo')->subject('Thông báo có khách hàng booking!');
	    });
        // Session::flash('flash_message', 'Send message successfully!');

        return response()->json($request->all(), 200);
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
        //
    }
}
