<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\CodeModel;
use App\model\HistoryModel;
use App\model\UserModel;
use Illuminate\Support\Str;

class CodeAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get('api_token'))->first();
            if($user)
            {
                $codes = CodeModel::orderBy('CREATED_AT','DESC')->get();
                return response()->json($codes, 200);
            }
            return response()->json(false, 401);
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
        if($request->has('api_token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get('api_token'))->first();
            if($user)
            {
                $code = CodeModel::create([
                    "UUID_CODE" => Str::uuid(),
                    "UUID_STORE" => $request->get("UUID_STORE"),
                    "NAME_CODE" => $request->get("NAME_CODE"),
                    "NOTE_CODE" => $request->get("NOTE_CODE"),
                    "SL_CODE" => $request->get("SL_CODE"),
                    "SL_CODED" => $request->get("SL_CODE")
                ]);
                HistoryModel::create([
                    "UUID_USER" => $user->UUID_USER,
                    "UUID_HISTORY" => Str::uuid(),
                    "NAME_HISTORY" => "Code",
                    "CONTENT_HISTORY" => $user->EMAIL. ' tạo mã code '.$request->get("NAME_CODE")
                ]);
                return response()->json($code, 200);
            }
            return response()->json(false, 401);
        }
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
