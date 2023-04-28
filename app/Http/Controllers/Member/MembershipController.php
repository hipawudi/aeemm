<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\Certificate;

class MembershipController extends Controller
{
    public function index()
    {
        $member = Member::with('certificates')->find(Auth()->user()->id);
        // $certs=Certificate::whereBelongsTo($member)->get();
        // dd($certs);

        return Inertia::render('Member/Membership', [
            'certificates' => Auth()->user()->member->certificates,
        ]);
    }
}
