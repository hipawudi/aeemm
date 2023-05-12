<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::paginate(request('per_page'));
        return response()->json($courses);
    }

    public function show(Course $course)
    {
        return response()->json($course);
    }
    public function getCourses(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);

        $courses = Course::paginate($perPage, ['*'], 'page', $page);

        return response()->json($courses);
    }

    public function getCourse(Request $request)
    {
        $course = Course::where('id', $request->id)->first();
        return response()->json($course);
    }
    public function getNewCourses()
    {
        $courses = Course::orderByDesc('start_date')->take(4)->get();

        return response()->json($courses);
    }
}
