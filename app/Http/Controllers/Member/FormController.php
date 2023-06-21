<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Form;
use App\Models\FormApplication;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()) {
            if (Auth()->user()->isMember) {
                $forms = Form::where('published', 1)->get();
            } else {
                $forms = Form::where('published', 1)->where('for_member', 0)->get();
            }
        } else {
            $forms = Form::where('published', 1)->where('for_account', 0)->where('for_member', 0)->get();
        }
        return Inertia::render('Forms/Form', [
            'forms' => $forms
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
        //date('Y-m-d',strtotime($request->date))
        // $this->validate($request,[
        //     'form_id'=>'required',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Form::with('fields')->where('course_id', $id)->first();
        $form_application = FormApplication::where('form_id', $form->id)->where('user_id', Auth()->user()->id)->first();
        if ($form->published == 0) {
            return redirect()->back()->withErrors(['message' => '本課程未開始報名']);
        } else if ($form->for_member == 1 && !Auth()->user()->member) {
            return redirect()->back()->withErrors(['message' => '抱歉，此課程只供會員報名']);
        } else if ($form_application) {
            return redirect()->back()->withErrors(['message' => '你已報名此課程']);
        }
        return Inertia::render('Forms/FormDefault', [
            'form' => $form,
        ]);
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
