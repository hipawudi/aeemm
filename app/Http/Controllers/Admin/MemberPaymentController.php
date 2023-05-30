<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Inertia\Inertia;
use App\Models\MemberPayment;

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
                $payment->member_id = $member->id;
                $payment->cost = $request->cost;
                $payment->cost_percentage = $request->cost_percentage;
                $payment->start_date = $request->start_date;
                $payment->end_date = $request->end_date;
                $payment->remark = $request->remark;
                $payment->state = $request->state;

                $payment->save();
            }
        } else {
            $payment = new MemberPayment;
            $payment->member_id = $request->mebmer_id;
            $payment->cost = $request->cost;
            $payment->cost_percentage = $request->cost_percentage;
            $payment->start_date = $request->start_date;
            $payment->end_date = $request->end_date;
            $payment->remark = $request->remark;
            $payment->state = $request->state;

            $payment->save();
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
}
