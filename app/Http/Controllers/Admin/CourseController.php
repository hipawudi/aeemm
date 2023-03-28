<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseController extends Controller
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
        return Inertia::render('Admin/Course',[
            'courses'=>Course::with('media')->get()
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
        $this->validate($request,[
            'name'=>'required',
            'title'=>'required',
        ]);

            $form=new Form();
            $form->name=$request->name;
            $form->title=$request->title;
            $form->description=$request->description;
            $form->require_login=$request->require_login;
            $form->require_member=$request->require_member;
            $form->save();
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        // $this->authorize('view',$organization);
        // $this->authorize('view',$form);
        return Inertia::render('Admin/CourseShow',[
            'course'=>$course->with('media')->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //$this->authorize('update',$organization);
        //$this->authorize('update',$form);
        return Inertia::render('Admin/CourseEdit',[
            'course'=>$course->with('media')->first()
        ]);
        
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
        $this->validate($request,[
            'id' => 'required',
            'title_zh'=>'required',
            // 'image'=>'array',
            // 'image.*.originFileObj' => 'image|mimes:jpeg,jpg,gif,png|max:1024'
        ]);
        $course=Course::find($request->id);
        $course->title_zh=$request->title_zh;
        $course->title_en=$request->title_en;
        $course->description_zh=$request->description_zh;
        $course->description_en=$request->description_en;
        $course->start_date=$request->start_date;
        $course->end_date=$request->end_date;
        $course->class_time=json_encode($request->class_time);
        $course->fee=$request->fee;
        $course->content=$request->content;
        $course->language=$request->language;
        $course->location=$request->location;
        $course->target=$request->target;
        $course->published=$request->published;
        $course->tutor=$request->tutor;
        if($request->file('poster')){
            $course->addMedia($request->file('poster')[0]['originFileObj'])->toMediaCollection('poster');
        }
        $course->save();
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
        if($form->hasChild()){
            return redirect()->back()->withErrors(['message'=>'No permission or restriced deletion of records with child records.']);
        }else{
            $form->delete();
            return redirect()->back();
        }
    }

    public function deleteMedia(Media $media){
        $media->delete();
    }    
}
