<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Offer;
use App\Models\Student;
use App\Models\Config;
use App\Models\Application;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->oid)){
            return redirect('/admin');
        };
        //$applications=Application::where('offer_id',$request->oid)->with('offer')->get();
        $offer=Offer::with('applications')->find($request->oid);
        $offers=Offer::availables();
        $idTypes=Config::item('id_types');
        return Inertia::render('Admin/Application',[
            'offer'=>$offer,
            'offers'=>$offers,
            'idTypes'=>$idTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $selectedOfferId=$request->oid?$request->oid:'2';
        $offers=Offer::availables();
        $idTypes=Config::item('id_types');
        return Inertia::render('Admin/ApplicationCreate',[
            'offers'=>$offers,
            'selectedOfferId'=>$selectedOfferId,
            'idTypes'=>$idTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'offer_id' => ['required'],
            'name_zh' => ['required'],
            'dob' => ['required'],
            'mobile' => ['required'],
        ])->validate();

        Application::create($request->all());
        return redirect('/admin');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application=Application::with('offer')->find($id);
        $offers=Offer::availables();
        $idTypes=Config::item('id_types');
        return Inertia::render('Admin/ApplicationEdit',[
            'application'=>$application,
            'offers'=>$offers,
            'idTypes'=>$idTypes
        ]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);
        $application->delete();
        return redirect('/admin/application?oid='.$id);
        
    }
}
