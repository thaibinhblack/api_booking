<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('type') && $request->has('value'))
        {
            $room = RoomModel::where($request->get('type'), $request->get('value'))->orderBy('CREATED_AT','asc')->get();
            return response()->json($room, 200);
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
        $room = RoomModel::create($request->all());
        return response()->json($room, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if($request->has('store'))
        {
            $room = RoomModel::join('booking_store','booking_room.UUID_STORE','booking_store.UUID_STORE')->join('booking_country','booking_store.UUID_COUNTRY','booking_country.UUID_COUNTRY')
            ->join('booking_province','booking_country.UUID_PROVINCE','booking_province.UUID_PROVINCE')->where('UUID_ROOM',$id)->first();
            return response()->json($room, 200);
        }
        
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
        RoomModel::where('UUID_ROOM',$id)->update($request->all());
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

