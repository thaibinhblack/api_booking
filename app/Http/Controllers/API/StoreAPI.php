<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\model\StoreModel;
use App\model\CountryModel;
use App\Http\Controllers\Controller;

class StoreAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('filter'))
        {
            $country = StoreModel::join('booking_country', 'booking_store.UUID_COUNTRY', 'booking_country.UUID_COUNTRY')->where('booking_country.'.$request->get('filter'), $request->get('value'))->get();
            return response()->json($country, 200);
        }
        $country = StoreModel::join('booking_country', 'booking_store.UUID_COUNTRY', 'booking_country.UUID_COUNTRY')->get();
        return response()->json($country, 200);
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
        $store = StoreModel::create($request->all());
        return response()->json($store, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = StoreModel::join("booking_country","booking_store.UUID_COUNTRY","booking_country.UUID_COUNTRY")->where("UUID_STORE",$id)->first();
        return response()->json($store, 200);
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
        if($request->has('update'))
        {
            StoreModel::where('UUID_STORE',$id)->update([
                $request->get('update') => $request->get('value')
            ]);
        }
        else {
            StoreModel::where('UUID_STORE',$id)->update([
                'NAME_STORE' => $request->get("NAME_STORE"),
                'ADDRESS_STORE' => $request->get("ADDRESS_STORE"),
                'PHONE_STORE' => $request->get("PHONE_STORE"),
                'UUID_COUNTRY'=> $request->get("UUID_COUNTRY")
            ]);
            return response()->json($request->all(), 200);
        }
        
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
