<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\Certificate;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professionals = Professional::with('certificate')->with('member')->with('media')->get();
        return Inertia::render('Admin/Professional', [
            'professionals' => $professionals,
            'certificates' => Certificate::all(),
            'members' => Member::all()
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
        $professinal = new Professional;

        $professinal->certificate_id = $request->certificate_id;
        $professinal->display_name = Member::where('id', $request->member_id)->first()->display_name;
        $professinal->member_id = $request->member_id;
        $professinal->number_display = substr('000' . strval(Professional::where('certificate_id', $request->certificate_id)->count() + 1), -4);
        $professinal->issue_date = $request->issue_date;
        $professinal->valid_from = $request->valid_from;
        $professinal->valid_until = $request->valid_until;
        $professinal->authorize_by = $request->authorize_by;

        $professinal->save();

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $professinal = Professional::where('id', $id)->first();

        $professinal->certificate_id = $request->certificate_id;
        $professinal->display_name = Member::where('id', $request->member_id)->first()->display_name;
        $professinal->member_id = $request->member_id;
        $professinal->number = $request->certificate_id;
        $professinal->number_display = $request->number_display;
        $professinal->issue_date = $request->issue_date;
        $professinal->valid_from = $request->valid_from;
        $professinal->valid_until = $request->valid_until;
        $professinal->authorize_by = $request->authorize_by;

        $professinal->save();

        return redirect()->back();
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
        $professinal = Professional::where('id', $id)->first();

        $professinal->delete();

        return redirect()->back();
    }

    public function members(Certificate $certificate)
    {
        return Inertia::render('Admin/Professional', [
            'certificate' => $certificate,
            'members' => $certificate->members
        ]);
    }
}
