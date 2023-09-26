<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Config as Config;
use Illuminate\Http\Request;
use App\Models\Member;
use Inertia\Inertia;
use App\Models\MemberPayment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemberPaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $member = Auth()->user()->member;
        if (empty($request->per_page)) {
            $per_page = 10;
        } else {
            $per_page = $request->per_page;
        }
        if ($request->category == 'all' || $request->category == null) {
            $payments = MemberPayment::where('member_id', $member->id)->paginate($per_page);
        } else if ($request->category == 'wait') {
            $payments = MemberPayment::where('member_id', $member->id)->where('state', 1)->paginate($per_page);
        } else if ($request->category == 'paymented') {
            $payments = MemberPayment::where('member_id', $member->id)->where('state', 2)->paginate($per_page);
        } else if ($request->category == 'result') {
            $payments = MemberPayment::where('member_id', $member->id)->where('state', 4)->orWhere('state', 3)->paginate($per_page);
        }

        return Inertia::render('Member/Payment', [
            'payments' => $payments,
            'category' => $request->category ?? 'all',
            'payment_states' => Config::item('payment_states'),
        ]);
    }
    public function create()
    {
    }
    public function edit()
    {
    }
    public function show(MemberPayment $payment)
    {
    }
    public function store(Request $request)
    {
    }
    public function update(MemberPayment $payment, Request $request)
    {
    }
    public function uploadPaymentImage(MemberPayment $payment, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['message' => '請選擇你的繳費單']);
        }
        $file = $request->file('payment')[0]['originFileObj'];

        $path = Storage::putFile('public/images/payment', $file);

        $payment->payment_image_path = $path;
        $payment->state = 2;
        $payment->save();

        return redirect()->back();
    }
    public function destroy(MemberPayment $payment)
    {
    }
}
