<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\Config;
use App\Notifications\EmailNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->per_page)) {
            $per_page = 10;
        } else {
            $per_page = $request->per_page;
        }

        $members = Member::with(['user' => function ($query) {
            $query->where('password', '!=', null)->where('password', '!=', 'need-to-set');
        }])->paginate($per_page);

        return Inertia::render('Admin/Member/List', [
            'members' => $members,
            'gender' => Config::item('gender'),
            'membership_levels' => Config::item('membership_levels'),
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
        //
        $this->validate($request, [
            'name_zh' => 'required',
            'state' => 'required',
        ]);
        $member = new Member;

        $member->name_zh = $request->name_zh;
        $member->gender = $request->gender;
        $member->birth = $request->birth;
        $member->address = $request->address;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->company = $request->company;
        $member->position = $request->position;
        $member->membership_level = $request->membership_level;
        $member->name_en = $request->name_en;
        $member->state = $request->state;

        $member->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
        $this->validate($request, [
            'name_zh' => 'required',
            'state' => 'required',
        ]);

        $member->name_zh = $request->name_zh;
        $member->gender = $request->gender;
        $member->birth = $request->birth;
        $member->address = $request->address;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->company = $request->company;
        $member->position = $request->position;
        $member->membership_level = $request->membership_level;
        $member->name_en = $request->name_en;
        $member->state = $request->state;

        $member->save();

        return redirect()->back();
        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Member::where('id', $id)->delete();

        return redirect()->back();
    }
    public function createLogin(Request $request)
    {
        $member = Member::where('id', $request->id)->first();
        if ($member->hasUser()) {
            $user = $member->user;
        } else {
            $user = $member->createUser();
            $member->user_id = $user->id;
            $member->save();
        }

        Password::broker(config('fortify.passwords'))->sendResetLink(
            ['email' => $user->email]
        );
    }
}
