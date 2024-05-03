<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Certificate;
use App\Models\Member;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CertificateController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::with('media')->get();
        return Inertia::render('Admin/Certificate', [
            'certificates' => $certificates,
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

        $validated =  $this->validate($request, [
            'cert_title' => 'required',
            'cert_body' => 'required',
            'number_format' => 'required',
            'cert_content',
            'cert_logo_path',
            'rank_caption',
            'description'
        ]);
        Certificate::Create($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        dd($certificate->members);
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
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'cert_title' => 'required',
            // 'cert_logo'=>'array',
            // 'cert_logo.*.originFileObj' => 'image|mimes:jpeg,jpg,gif,png|max:1024'
        ]);

        $certificate = Certificate::find($id);
        $certificate->name = $request->name;
        $certificate->cert_title = $request->cert_title;
        $certificate->cert_body = $request->cert_body;
        $certificate->cert_template = $request->cert_template;
        $certificate->number_format = $request->number_format;
        $certificate->rank_caption = $request->rank_caption;
        $certificate->description = $request->description;
        if ($request->file('cert_logo')) {
            $certificate->addMedia($request->file('cert_logo')[0]['originFileObj'])->toMediaCollection('cert_logo');
        }
        $certificate->save();
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
    }

    public function members(Certificate $certificate)
    {
        $this->authorize('view', $certificate);
        return Inertia::render('Admin/CertificateMember', [
            'certificate' => $certificate,
            'members' => $certificate->members
        ]);
    }

    public function deleteMedia(Media $media)
    {
        $media->delete();
    }
}
