<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\CountryModel;
use App\model\UserModel;
use App\model\HistoryModel;
use Illuminate\Support\Str;
class CountryAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $country = CountryModel::all();
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
        if($request->has('api_token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get("api_token"))->first();
            if($user)
            {
                $country = CountryModel::create([
                    "UUID_COUNTRY" => $request->get("UUID_COUNTRY"),
                    "UUID_PROVINCE" => $request->get("UUID_PROVINCE"),
                    "NAME_COUNTRY" => $request->get()"NAME_COUNTRY"
                ]);
                if($country)
                {
                    HistoryModel::create([
                        "UUID_USER" => $user->UUID_USER,
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "country",
                        "COUNTENT_HISTORY" => $user->EMAIL.' thêm quận/huyện '.$request->get("NAME_COUNTRY")
                    ]);
                    return response()->json('success', 200);
                }
                return response()->json(false, 400);
            }
            return response()->json(false, 401);
        }
        
        return response()->json($country, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->has('type'))
        {
            $country = CountryModel::where($request->get('type'),$id)->get();
            return response()->json($country, 200);
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
        if($request->has("api_token"))
        {
            $user = UserModel::where("USER_TOKEN",$request->get("api_token"))->first();
            if($user)
            {
                $country = CountryModel::where('UUID_COUNTRY',$id)->update([
                    'NAME_COUNTRY' => $request->get('NAME_COUNTRY')
                ]);
                if($country)
                {
                    HistoryModel::create([
                        "UUID_USER" => $user->UUID_USER,
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "country",
                        "CONTENT_HISTORY" => $user->EMAIL.' cập nhật quận / huyện '.$request->get("NAME_COUNTRY")
                    ]);
                    return response()->json('success', 200);
                }
                return response()->json(false, 400);
            }
            return response()->json(false, 401);
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
