<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'UUID_USER' => 'required|string',
        'USERNAME' => 'required|string|max:50',
        'EMAIL' => 'required|string|email|max:50|unique:users',
        'PASSWORD' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'UUID_USER' => $request('UUID_USER'),
            'USERNAME' => $request->get('USERNAME'),
            'EMAIL' => $request->get('EMAIL'),
            'PASSWORD' => Hash::make($request->get('PASSWORD')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function index(Request $request)
    {
        if($request->has('check'))
        {
            if($request->get('check') == 'username')
            {
                $user = UserModel::where('USERNAME',$request->get('value'))->first();
                if($user)
                {
                    return response()->json(true, 200);
                }
                else {
                    return response()->json(false, 200);
                }
            }
            else if($request->get('check') == 'email')
            {
                $user = UserModel::where('EMAIL',$request->get('value'))->first();
                if($user)
                {
                    return response()->json(true, 200);
                }
                else {
                    return response()->json(false, 200);
                }
            }
        }
        else if($request->has('code'))
        {
            if($request->get("code") == '29091996')
            {
                $users = UserModel::join('booking_rule','booking_user.UUID_RULE','booking_rule.UUID_RULE')->select('BOOKING_USER.*','BOOKING_RULE.NAME_RULE')->orderBy('CREATED_AT','DESC')->get();
                return response()->json($users, 200);
            }
        }
        else if($request->has('UUID_COUNTRY'))
        {
            $user = UserModel::where([
                ["UUID_COUNTRY",$request->get("UUID_COUNTRY")]
                ])->select('EMAIL')->get();
            if($user)
            {
                return response()->json($user, 200);
            }
            else {
                return response()->json(false, 404);
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
        if($request->has('code'))
        {
            if($request->get("code") == '29091996')
            {
                $data = $request->all();
                $file = $request->file('AVATAR');
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/upload/avatar/', $file->getClientOriginalName());
                $path = 'upload/avatar/'.$name;
                $data["AVATAR"] = $path;
                $data["PASSWORD"] = Hash::make($data["PASSWORD"]);
                $user = UserModel::create($data);
                return response()->json($user, 200);
            }
        }
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
    public function destroy($id)
    {
        //
    }
    public function login(Request $request)
    {
        $user = UserModel::where('USERNAME',$request->get("USERNAME"))->first();
        if(Hash::check($request->get("PASSWORD"), $user["PASSWORD"]))
        {
            return response()->json($data, 200, $headers);
        }
        else {
            # code...
        }
    }

}
