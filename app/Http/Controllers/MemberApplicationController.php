<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use App\Models\Config;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberApplicationController extends Controller
{
    //
    public function index()
    {
    }
    public function create()
    {
        $user = Auth()->user();
        $memberApplication = MemberApplication::where('user_id', $user->id)->first();
        return Inertia::render('MemberApplication', [
            'member_application' => $memberApplication,
            'gender' => Config::item('gender'),
            'membership_levels' => Config::item('membership_levels'),
        ]);
    }
    public function store(Request $request)
    {
        $member_application = new MemberApplication;

        $member_application->name_zh = $request->name_zh;
        $member_application->user_id = Auth()->user()->id;
        $member_application->gender = $request->gender;
        $member_application->birth = $request->birth;
        $member_application->address = $request->address;
        $member_application->email = $request->email;
        $member_application->phone = $request->phone;
        $member_application->company = $request->company;
        $member_application->position = $request->position;
        $member_application->membership_level = $request->membership_level;
        $member_application->name_en = $request->name_en;
        $member_application->state = 0;

        $member_application->save();

        return redirect()->back();
    }
}
