<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Course;
use App\Models\Member;
use App\Models\MemberApplication;
use App\Models\Message;
use App\Models\Professional;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $members_count = Member::all()->count();
        $courses_count = Course::all()->count();
        $professionals_count = Professional::all()->count();
        $bulletins_count = Bulletin::all()->count();
        $application_members_count = MemberApplication::where('state', 0)->get()->count();
        // dd($members_count);
        return Inertia::render('Admin/Dashboard', [
            'membersCount' => $members_count,
            'coursesCount' => $courses_count,
            'professionalsCount' => $professionals_count,
            'bulletinsCount' => $bulletins_count,
            'ApplicationMembersCount' => $application_members_count,
        ]);
    }
}
