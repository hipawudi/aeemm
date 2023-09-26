<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberApplication;
use App\Models\Config;
use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberApplicationController extends Controller
{
    //
    public function index(Request $request)
    {
        if (empty($request->per_page)) {
            $per_page = 10;
        } else {
            $per_page = $request->per_page;
        }
        $member_applications = MemberApplication::paginate($per_page);
        return Inertia::render('Admin/Member/Application', [
            'member_applications' => $member_applications,
            'gender' => Config::item('gender'),
            'membership_levels' => Config::item('membership_levels'),
            'member_application_state' => Config::item('member_application_state'),
        ]);
    }
    public function create()
    {
    }
    public function pass(Request $request)
    {
        $member = new Member;

        $member->name_zh = $request->name_zh;
        $member->user_id = $request->user_id;
        $member->gender = $request->gender;
        $member->birth = $request->birth;
        $member->address = $request->address;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->company = $request->company;
        $member->position = $request->position;
        $member->membership_level = $request->membership_level;
        $member->name_en = $request->name_en;
        $member->state = 1;

        $member->save();

        $member_application = MemberApplication::where('id', $request->id)->first();
        $member_application->state = 1;
        $member_application->save();
    }
    public function reject(Request $request)
    {
        $member_application = MemberApplication::where('id', $request->id)->first();
        $member_application->state = 2;
        $member_application->save();
    }
    public function store(Request $request)
    {
    }
}
