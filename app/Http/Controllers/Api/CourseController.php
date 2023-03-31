<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function index(){
        $courses=Course::paginate(request('per_page'));
        return response()->json($courses);
    }

    public function show(Course $course){
        return response()->json($course);
    }

}
