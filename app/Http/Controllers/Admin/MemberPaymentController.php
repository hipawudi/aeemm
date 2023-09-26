<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config as Config;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\EmailLog;
use Inertia\Inertia;
use App\Models\MemberPayment;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class MemberPaymentController extends Controller
{
    //
    public function index(Request $request)
    {

        if (empty($request->per_page)) {
            $per_page = 10;
        } else {
            $per_page = $request->per_page;
        }

        $payments = MemberPayment::paginate($per_page);

        $members = Member::all();
        return Inertia::render('Admin/Member/Payment', [
            'payments' => $payments,
            'members' => $members,
            'payment_states' => Config::item('payment_states'),
        ]);
    }
    public function create()
    {
    }
    public function edit()
    {
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required',
            'cost' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'state' => 'required',
        ]);
        if ($request->member_id == 0) {
            $members = Member::all();
            foreach ($members as $member) {
                $payment = new MemberPayment;
                $payment->title = $request->title;
                $payment->member_id = $member->id;
                $payment->cost = $request->cost;
                $payment->cost_percentage = $request->cost_percentage;
                $payment->start_date = $request->start_date;
                $payment->end_date = $request->end_date;
                $payment->remark = $request->remark;
                $payment->state = $request->state;
                $payment->save();
                if ($request->send_email) {
                    $this->sendPaymentMail($member, $request);
                }
            }
        } else {
            $member = Member::where('id', $request->member_id)->first();
            $payment = new MemberPayment;
            $payment->title = $request->title;
            $payment->member_id = $request->member_id;
            $payment->cost = $request->cost;
            $payment->cost_percentage = $request->cost_percentage;
            $payment->start_date = $request->start_date;
            $payment->end_date = $request->end_date;
            $payment->remark = $request->remark;
            $payment->state = $request->state;
            $payment->save();
            if ($request->send_email) {
                $this->sendPaymentMail($member, $request);
            }
        }
        return redirect()->back();
    }
    public function update(MemberPayment $payment, Request $request)
    {
        $this->validate($request, [
            'member_id' => 'required',
            'cost' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'state' => 'required',
        ]);

        $payment->member_id = $request->member_id;
        $payment->cost = $request->cost;
        $payment->cost_percentage = $request->cost_percentage;
        $payment->start_date = $request->start_date;
        $payment->end_date = $request->end_date;
        $payment->remark = $request->remark;
        $payment->state = $request->state;

        $payment->save();

        return redirect()->back();
    }

    public function destroy(MemberPayment $payment)
    {
        $payment->delete();

        return redirect()->back();
    }
    public function sendPaymentMail($member, $payment)
    {
        $mail = [
            'subject' => $payment->title,
            'greeting' => 'Hi ' . $member->name_zh,
            'body' => 'The new membership fee invoice has been issued. Please submit your payment proof before ' . $payment->end_date . '.',
            'actionText' => 'GO to AEEMM',
            'actionURL' => url('/'),
        ];
        $email_log = new EmailLog;
        $email_log->status = 0;
        try {
            Notification::send($member, new EmailNotification($mail));
            $email_log->status = 1;
        } catch (\Exception $e) {
            $email_log->status = 2;
            $email_log->error_message = $e->getMessage();
        }

        $email_log->member_id = $member->id;
        $email_log->title = $payment->title;
        $email_log->content = 'The new membership fee invoice has been issued. Please submit your payment proof before ' . $payment->end_date . '.';

        $email_log->save();
    }
}
