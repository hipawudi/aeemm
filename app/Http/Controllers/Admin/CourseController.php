<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use App\Models\CourseImage;
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
        return Inertia::render('Admin/Course/Index', [
            'courses' => Course::with('media')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Course/Create', []);
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
            'name_zh' => 'required',
            // 'image'=>'array',
            // 'image.*.originFileObj' => 'image|mimes:jpeg,jpg,gif,png|max:1024'
        ]);
        $course = new Course;
        $course->name_zh = $request->name_zh;
        $course->name_en = $request->name_en;
        $course->scope = $request->scope;
        $course->description_zh = $request->description_zh;
        $course->description_en = $request->description_en;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->class_time = $request->class_time;
        $course->hours = $request->hours;
        $course->quota = $request->quota;
        $course->number = $request->number;
        $course->fee = $request->fee;
        $course->fee_member = $request->fee_member;
        $course->content = $request->content;
        $course->language = $request->language;
        $course->location = $request->location;
        $course->target = $request->target;
        $course->published = is_null($request->published) ? 0 : $request->published;
        $course->tutor = $request->tutor;

        if ($request->file('poster')) {
            $course->addMedia($request->file('poster')[0]['originFileObj'])->toMediaCollection('poster');
        }
        $course->save();
        return redirect()->route('admin.courses.index');
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
        return Inertia::render('Admin/Course/Show', [
            'course' => $course->with('media')->first()
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
        return Inertia::render('Admin/Course/Edit', [
            'course' => $course
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
        $this->validate($request, [
            'id' => 'required',
            'name_zh' => 'required',
            // 'image'=>'array',
            'poster.*.originFileObj' => 'image|mimes:jpeg,jpg,gif,png|max:1024'
        ]);
        // dd($request->poster);
        $course = Course::find($request->id);
        $course->name_zh = $request->name_zh;
        $course->name_en = $request->name_en;
        $course->scope = $request->scope;
        $course->description_zh = $request->description_zh;
        $course->description_en = $request->description_en;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->class_time = $request->class_time;
        $course->hours = $request->hours;
        $course->quota = $request->quota;
        $course->number = $request->number;
        $course->fee = $request->fee;
        $course->fee_member = $request->fee_member;
        $course->content = $request->content;
        $course->language = $request->language;
        $course->location = $request->location;
        $course->target = $request->target;
        $course->published = $request->published;
        $course->tutor = $request->tutor;
        
        if ($request->hasFile('poster')) {
            $file = $request->file('poster')[0]['originFileObj'];

            $path = Storage::putFile('public/images/course', $file);

            $course->poster_path = $path;
        }
        $course->save();

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        if ($form->hasChild()) {
            return redirect()->back()->withErrors(['message' => 'No permission or restriced deletion of records with child records.']);
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
