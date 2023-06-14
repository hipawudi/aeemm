<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 9;
        if ($request->per_page != null) {
            $perPage = $request->per_page;
        }

        if ($request->category == 'all' || $request->category == null) {
            $courses = Course::with('form')->where('published', 1)->paginate($perPage);
        } else if ($request->category == 'new') {
            $courses = Course::with('form')->where('published', 1)->whereDate('end_date', '>=', date('Y-m-d'))->paginate($perPage);
        } else if ($request->category == 'old') {
            $courses = Course::with('form')->where('published', 1)->whereDate('end_date', '<', date('Y-m-d'))->paginate($perPage);
        }

        return Inertia::render('Courses/CourseBlog', [
            'courses' => $courses,
            'category' => $request->category ?? 'all',
        ]);
    }
    public function show(Course $course)
    {
        return Inertia::render('Courses/CourseDetail', [
            'course' => $course
        ]);
    }
    public function detail(Course $course)
    {
        return Inertia::render('Courses/CourseDetail', [
            'course' => $course->with('media')->first()
        ]);
    }
}
