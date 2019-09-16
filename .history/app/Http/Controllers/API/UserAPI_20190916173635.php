<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegisterAuthRequest;
use App\model\HistoryModel;
use Illuminate\Support\Str;

class UserAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        
    }
    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            $user = UserModel::where('USER_TOKEN', $request->get('api_token'))->first();
            if($user)
            {
                if($user->UUID_RULE == 'manager-2019')
                {
                    $users = UserModel::orderBy('CREATED_AT','DESC')->get();
                    
                    return response()->json($users, 200);
                }
                else {
                    return response()->json('error', 401);
                }
            }
        }
        else if($request->get('check'))
        {
            $user = UserModel::where('EMAIL',$request->get('value'))->first();
            if($user)
            {
                return response()->json(false, 200);
            }
            else {
                return response()->json(true, 200);
            }
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
        if($request->has('api_token'))
        {
            $user = UserModel::where("USER_TOKEN", $request->get('api_token'))->first();
            if($user)
            {
                if($user->UUID_RULE == 'manager-2019')
                {
                    $data = $request->all();
                    if($request->has('AVATAR'))
                    {
                        $file = $request->file('AVATAR');
                        $name = $file->getClientOriginalName();
                        $file->move(public_path().'/upload/avatar/', $file->getClientOriginalName());
                        $path = 'upload/avatar/'.$name;
                        $data["AVATAR"] = $path;
                    }
                    $data["PASSWORD"] = Hash::make($data["PASSWORD"]);
                    $user_new = UserModel::create($data);
                    HistoryModel::create([
                        "UUID_USER" => $user->UUID_USER,
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "user",
                        "CONTENT_HISTORY" => $user->EMAIL.' vừa tạo user '.$user_new->EMAIL
                    ]);
                    return response()->json($user_new, 200);
                }
                else {
                    return response()->json('error', 401);
                }
            }
            return response()->json('error', 404);
        }
        return response()->json('error', 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->has('code'))
        {
            if($request->get("code") == "29091996")
            {
                $user = UserModel::where("UUID_USER",$id)->first();
                if($user)
                {
                    return response()->json($user, 200);
                }
                else {
                    return response()->json(false, 404);
                }
            }
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
        $data = $request->all();
        if($request->has('PASSWORD'))
        {
            $data["PASSWORD"] = Hash::make($data["PASSWORD"]);
        }
        $user = UserModel::where("UUID_USER",$id)->update($data);
        return response()->json($request->all(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        if($request->has('api_token'))
        {
            $user = UserModel::where([
                ["USER_TOKEN",$request->get('api_token')],
                ["UUID_RULE", 'manager-2019']]->first();
            if($user)
            {
                
            }
        }
    }
    public function login(Request $request)
    {
        $user = UserModel::where('EMAIL',$request->get("EMAIL"))->first();
        if($user)
        {
            if(Hash::check($request->get("PASSWORD"), $user["PASSWORD"]))
            {
                $token = JWTAuth::fromUser($user);
                $user = UserModel::where('EMAIL',$request->get("EMAIL"))->update([
                    "USER_TOKEN" => $token
                ]);
                return response()->json($token, 200);
            }
            else {
                return response()->json(false, 404);
            }
        }
        else {
            return response()->json('error', 404);
        }
            
    }
    public function logout(Request $request)
    {
        $user= UserModel::where('USER_TOKEN',$token)->update([
            "USER_TOKEN" => NULL
        ]);
        return response()->json($user, 200);
    }
    public function getUserByToken(Request $request)
    {
        $token = $request->get('api_token');
        $user= UserModel::where('USER_TOKEN',$token)->first();
        if($user)
        {
            return response()->json($user, 200);
        }
        else {
            return response()->json(false, 404);
        }
    }   

}
