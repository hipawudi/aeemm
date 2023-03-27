<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $messages=Message::where('scope','public')->orderBy('id','DESC')->take(5)->get();
        return Inertia::render('Member/Dashboard',[
            'member'=>Auth()->user()->member,
            'messages'=>$messages
        ]);
    }
    
}
