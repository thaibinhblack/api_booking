<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\ServiceModel;
use App\model\UserModel;
use App\model\HistoryModel;
use Illuminate\Support\Str;
class ServiceAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = ServiceModel::all();
        return response()->json($service, 200);
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
                $file = $request->file('IMAGE_SERVICE');
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/upload/services/', $file->getClientOriginalName());
                $path = 'upload/services/'.$name;
                $data = $request->all();
                $data["IMAGE_SERVICE"] = $path;
                $service = ServiceModel::create([
                    "UUID_SERVICE" => $data["UUID_SERVICE"],
                    "NAME_SERVICE" => $data["NAME_SERVICE"],
                    "IMAGE_SERVICE" => $data["IMAGE_SERVICE"]
                ]);
                HistoryModel::create([
                    "UUID_USER" => $user->UUID_USER,
                    "UUID_HISTORY" => Str::uuid(),
                    "NAME_HISTORY" => 'Dịch vụ',
                    "CONTENT_HISTORY" => $user->EMAIL.' vừa thêm dịch vụ '.$data["NAME_SERVICE"]
                ]);
                return response()->json('success', 200);
            }
            return response()->json('error', 401);
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
        if($request->has('api_token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get('api_token'))->first();
            if($user)
            {
                $data = $request->all();
                if($request->has('IMAGE_SERVICE'))
                {
                    $file = $request->file('IMAGE_SERVICE');
                    $name = $file->getClientOriginalName();
                    $file->move(public_path().'/upload/services/', $file->getClientOriginalName());
                    $path = 'upload/services/'.$name;
                    $data["IMAGE_SERVICE"] = $path;
                    ServiceModel::where("UUID_SERVICE",$id)->update([
                        "NAME_SERVICE" => $data["NAME_SERVICE"],
                        "IMAGE_SERVICE" => $data["IMAGE_SERVICE"]
                    ]);
                }
                else {
                    ServiceModel::where("UUID_SERVICE",$id)->update([
                        "NAME_SERVICE" => $data["NAME_SERVICE"]
                    ]);
                }
                HistoryModel::create([
                    "UUID_USER" => $user->UUID_USER,
                    "UUID_HISTORY" => Str::uuid(),
                    "NAME_HISTORY" => "Dịch vụ",
                    "CONTENT_HISTORY" => $user->EMAIL. ' vừa cập nhật dịch vụ '$data["NAME_SERVICE"]
                ]);
                return response()->json('success', 200);
               
            }
            return response()->json('error', 401);
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
