<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo;
use App\model\HistoryModel;
use Illuminate\Support\Str;
class SMSAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to'   => '84'.$request->get('phone'),
            'from' => '16105552344',
            'text' => 'CAM ON QUY KHACH DA DANG KY DICH VU!'
        ]);
        return response()->json($nexmo, 200);
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
            $usser = UserModel::where("USER_TOKEN",$request->get('api_token'))->first();
            if($usser)
            {
                $nexmo = app('Nexmo\Client');
                $nexmo->message()->send([
                    'to'   => '84'.$request->get('phone'),
                    'from' => '16105552344',
                    'text' => $request->get('message')
                ]);
                HistoryModel::create([
                    "UUID_USER" => $usser->UUID_USER,
                    "UUID_HISTORY" => Str::uuid(),
                    "NAME_HISTORY" => "SMS",
                    "CONTENT_HISTORY" => $usser->EMAIL. 'gửi sms cho thuê bao '.$request->get('phone').' với nội dung: '.$request->get('message')                
                    ]);
                return response()->json($nexmo, 200);
            }
        }
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to'   => '84'.$request->get('phone'),
            'from' => '16105552344',
            'text' => $request->get('message')
        ]);
        return response()->json($nexmo, 200);

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
