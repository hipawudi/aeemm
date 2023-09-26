<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Email;
use App\Models\EmailLog;
use App\Models\User;
use App\Services\PayUService\Exception;
use App\Models\Member;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class EmailController extends Controller
{
    //
    public function __construct()
    {
    }

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

        $email_logs = EmailLog::orderBy('id', 'desc')->paginate($per_page);
        $members = Member::all();
        // dd($members);
        return Inertia::render('Admin/Email/Index', [
            'email_logs' => $email_logs,
            'members' => $members,
        ]);
    }

    public function create()
    {
        $members = Member::all();
        return Inertia::render('Admin/Email/Create', [
            'members' => $members
        ]);
    }

    public function store(Request $request)
    {
        $error = 0;
        $success = 0;
        foreach ($request->member as $m) {
            $member = Member::where('id', $m)->first();
            $mail = [
                'subject' => $request->title,
                'greeting' => 'Hi ' . $member->name_zh,
                'body' => $request->content,
                'actionText' => 'GO to AEEMM',
                'actionURL' => url('/'),
            ];
            $email_log = new EmailLog;
            $email_log->status = 0;
            try {
                Notification::send($member, new EmailNotification($mail));
                $email_log->status = 1;
                $success++;
            } catch (\Exception $e) {
                $email_log->status = 2;
                $email_log->error_message = $e->getMessage();
                $error++;
            }

            $email_log->member_id = $member->id;
            $email_log->title = $request->title;
            $email_log->content = $request->content;

            $email_log->save();
        }
        if ($error > 0) {
            return redirect()->back()->withErrors(['message' => '發送成功: ' . $success . ' 發送失敗: ' . $error]);
        } else {
            return redirect()->back();
        }
    }
}
