<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Form;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
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
    public function index()
    {
        return Inertia::render('Admin/Form/Index', [
            'forms' => Form::with('media')->get()
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
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
        ]);

        $form = new Form();
        $form->name = $request->name;
        $form->title = $request->title;
        $form->description = $request->description;
        $form->for_account = $request->for_account;
        $form->for_member = $request->for_member;
        $form->published = $request->published;
        $form->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        // $this->authorize('view',$organization);
        // $this->authorize('view',$form);

        echo 'edit form';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //$this->authorize('update',$organization);
        //$this->authorize('update',$form);
        // return Inertia::render('Admin/FormEdit',[
        //     'fields'=>$form->fields
        // ]);

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
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'title' => 'required',
            // 'image'=>'array',
            // 'image.*.originFileObj' => 'image|mimes:jpeg,jpg,gif,png|max:1024'
        ]);
        $form = Form::find($request->id);
        $form->name = $request->name;
        $form->title = $request->title;
        $form->description = $request->description;
        $form->for_account = $request->for_account;
        $form->for_member = $request->for_member;
        $form->published = $request->published;
        if ($request->file('image')) {
            $form->addMedia($request->file('image')[0]['originFileObj'])->toMediaCollection('image');
        }
        $form->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        if ($form->hasCourse()) {
            return redirect()->back()->withErrors(['message' => '不能刪除課程表格。']);
        } else if ($form->hasChild()) {
            return redirect()->back()->withErrors(['message' => '不能刪除帶有欄位的表格。']);
        } else {
            $form->delete();
            return redirect()->back();
        }
    }

    public function deleteMedia(Media $media)
    {
        $media->delete();
    }
}
