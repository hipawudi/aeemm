<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormFieldController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Organization::class);
        // $this->authorizeResource(Form::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Form $form)
    {
        return Inertia::render('Admin/Form/Field', [
            'form' => $form,
            'fields' => $form->fields,
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
    public function store(Form $form, Request $request)
    {
        $this->validate($request, [
            'form_id' => 'required',
            'field_label' => 'required',
        ]);

        $field = new FormField();
        $field->form_id = $request->form_id;
        $field->field_label = $request->field_label;
        $field->type = $request->type;
        $field->require = $request->require;
        $field->rule = $request->rule;
        $field->validate = $request->validate;
        $field->remark = $request->remark;
        $field->save();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form $form, Request $request)
    {
        $this->validate($request, [
            'form_id' => 'required',
            'field_label' => 'required',
        ]);
        $field = FormField::find($request->id);
        $field->form_id = $request->form_id;
        $field->field_label = $request->field_label;
        $field->type = $request->type;
        $field->require = $request->require;
        $field->remark = $request->remark;
        $field->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form, FormField $field)
    {
        $field->delete();
    }
}
