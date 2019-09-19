<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\StylistModel;

class StylistAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stylist = StylistModel::all();
        return response()->json($stylist, 200);
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
        $file = $request->file('URL_STYLIST');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/upload/stylists/', $file->getClientOriginalName());
        $path = 'upload/stylists/'.$name;
        $data = $request->all();
        $data["URL_STYLIST"] = $path;
        $stylist = StylistModel::create($data);
        return response()->json($stylist, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stylist = StylistModel::where("UUID_STYLIST",$id)->first();
        return response()->json($stylist, 200);
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
        $data = $request->all();
        if($request->has('URL_STYLIST'))
        {
            $file = $request->file('URL_STYLIST');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/upload/stylists/', $file->getClientOriginalName());
            $path = 'upload/stylists/'.$name;
            
            $data["URL_STYLIST"] = $path;
        }
        
        $stylist = StylistModel::where('UUID_STYLIST',$id)->update($data);
        return response()->json($stylist, 200);
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