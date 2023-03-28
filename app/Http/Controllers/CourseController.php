<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $courses=Course::where('published',1)->get();
        return Inertia::render('Courses/CourseBlog',[
            'courses'=>$courses
        ]);
    }

    public function detail(Course $course){
        return Inertia::render('Courses/CourseDetail',[
            'course'=>$course->with('media')->first()
        ]);

    }
}
