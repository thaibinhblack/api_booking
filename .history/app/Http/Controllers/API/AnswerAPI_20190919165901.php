<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\AnswerModel;
use App\model\UserModel;
use App\model\HistoryModel;
use Illuminate\Support\Str;
class AnswerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('UUID_QUESTION'))
        {
            $answers = AnswerModel::where("UUID_QUESTION",$request->get("UUID_QUESTION"))->get();
            return response()->json($answers, 200);
        }
        $answer = AnswerModel::orderBy('CREATED_AT','asc')->get();
        return response()->json($answer, 200);
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
                $answer = AnswerModel::create([
                    "UUID_ANWSER" => Str::uuid(),
                    "UUID_QUESTION" => $request->get("UUID_QUESTION"),
                    "NAME_ANWSER" => $request->GET("NAME_ANWSER")
                ]);
                if($answer)
                {
                    HistoryModel::create([
                        "UUID_USER" => $user->UUID_USER,
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "anwser",
                        "CONTETN_HISTORY" => $user->EMAIL.' tạo câu trả lời '.$request->GET("NAME_ANWSER")
                    ]);
                    return response()->json($answer, 200);
                }
                return response()->json(false, 400);
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
        if($request->has('token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get("token"));
            if($user)
            {
                $answer =  AnswerModel::where("UUID_ANSWER",$id)->update([
                    "NAME_ANWSER" => $request->get("NAME_ANWSER")
                ]);
                if($answer)
                {
                    HistoryModel::create([
                        "UUID_USER" => $user->UUID_USER,
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "anwser",
                        "CONTENT_HISTORY" => $user->EMAIL.' cập nhật câu trả lời '.$request->get("NAME_ANWSER")
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
    public function destroy($id,Request $request)
    {
        if($request->has('token'))
        {
            $user = UserModel::where("USER_TOKEN",$request->get("token"));
            if($user)
            {   $answer_delete =  AnswerModel::where("UUID_ANWSER",$id)->first();
                $answer =  AnswerModel::where("UUID_ANWSER",$id)->delete(); 
                if($answer)
                {
                    HistoryModel::create([
                        "UUID_USER" => $user->UUID_USER,
                        "UUID_HISTORY" => Str::uuid(),
                        "NAME_HISTORY" => "anwser",
                        "CONTENT_HISTORY" => $user->EMAIL.' xóa câu trả lời '.$answer_delete->NAME_HISTORY
                    ]);
                    return response()->json('success', 200);
                }
                return response()->json(false, 400);
            }
            return response()->json(false, 401);
        }
    }
}