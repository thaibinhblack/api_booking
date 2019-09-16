<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\QuestionModel;
use App\model\AnswerModel;
use App\model\UserQuestionAnwser;
use App\model\UserModel;
use App\model\HistoryModel;
class QuestionAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = QuestionModel::all();
        return response()->json($question, 200);
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
        $question = QuestionModel::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    public function destroy($id,Request $request)
    {
        if($request->has('api_token'))
        {
            
            $user = UserModel::where('USER_TOKEN', $request->get('api_token'))->first();
            return response()->json($user, 200);
            if($user)
            {
                $answers = AnswerModel::where("UUID_QUESTION",$id)->get();
                foreach ($answers as $answer) {
                    UserQuestionAnwser::where("UUID_ANWSER",$answer["UUID_ANWSER"])->delete();
                }
                $qusstion_delete = QuestionModel::where("UUID_QUESTION",$id)->frist();
                $question = QuestionModel::where("UUID_QUESTION",$id)->delete();
                
                HistoryModel::create([
                    "UUID_USER" => $user->UUID_USER,
                    "UUID_HISTORY" => Str::uuid(),
                    "NAME_HISTORY" => "Câu hỏi",
                    "CONTENT_HISTORY" => $user->EMAIL. ' xóa câu hỏi '.$qusstion_delete->NAME_QUESTION
                ]);
                return response()->json('success', 200);
            }
            
            return response()->json('error', 401);
        }
       

    }
}
