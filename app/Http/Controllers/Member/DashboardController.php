<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Message;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $member = Auth()->user()->member;
        if ($member) {
            $messages = Message::where('category', 'public')->orWhere('category', 'member')->orWhere('receiver', $member->name)->orderBy('id', 'DESC')->take(7)->get();
        } else {
            $messages = Message::where('category', 'public')->orderBy('id', 'DESC')->take(7)->get();
        }
        $messages = collect($messages)->map(function ($m, $key) {
            $m['send_date'] = Carbon::parse($m['created_at'])->format('Y-m-d H:i:s');
            return $m;
        });

        // dd($messages);
        return Inertia::render('Member/Dashboard', [
            'member' => $member,
            'messages' => $messages
        ]);
    }
}
