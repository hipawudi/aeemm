<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Survey;
use App\Models\Question;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sid=$request->sid;
        $survey=Survey::find($sid);
        $questions=Question::whereBelongsTo($survey)->get();
        return Inertia::render('Admin/Question',[
            'survey'=>$survey,
            'questions'=>$questions
        ]);
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
        Validator::make($request->all(), [
            'field_name' => ['required'],
            'title_cn' => ['required'],
        ])->validate();

        Question::create($request->all());
        return redirect()->back();
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
        Validator::make($request->all(), [
            'field_name' => ['required'],
            'title_cn' => ['required'],
        ])->validate();
        
        if($request->has('id')){
            $question=Question::find($id);
            $question->field_name=$request->field_name;
            $question->title_cn=$request->title_cn;
            $question->title_en=$request->title_en;
            $question->mandatory=$request->mandatory;
            $question->format=$request->format;
            $question->rule=$request->rule;
            $question->type=$request->type;
            $question->option_cn=$request->option_cn;
            $question->option_en=$request->option_en;
            $question->other=$request->other;
            $question->other_label=$request->other_label;
            $question->save();
            return redirect()->back();
        }else{
            return redirect()->back();
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
