<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\model\ProvinceModel;
use App\Http\Controllers\Controller;
use App\model\UserModel;
use App\model\HistoryModel;
use Illuminate\Support\Str;
class ProvinceAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ProvinceModel::all(), 200);
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
        if($request->has('api_token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get('api_token'))->first();
            if($user)
            {
                $province = ProvinceModel::create([
                    "UUID_PROVINCE" => $request->get("UUID_PROVINCE"),
                    "NAME_PROVICE" => $request->get("NAME_PROVICE")
                ]);
                if($province)
                {
                    HistoryModel::create([
                        "UUID_USER" => $request->get("UUID_USER"),
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "Tỉnh / Thành Phố",
                        "CONTENT_HISTORY" => $user->EMAIL.' thêm thành phố '.$request->get("NAME_PROVICE")
                    ])
                }
            }
        }
        $province = ProvinceModel::create($request->all());
        return response()->json($province, 200);
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
        //
    }
}