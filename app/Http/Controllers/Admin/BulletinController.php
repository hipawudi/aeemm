<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\Bulletin;
use App\Models\Config;
use Illuminate\Support\Facades\Storage;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulletins = Bulletin::paginate(request('per_page'));
        // dd(Config::item('bulletin_categories'));
        return Inertia::render('Admin/Bulletin', [
            'bulletins' => $bulletins,
            'bulletinCategories' => Config::item('bulletin_categories'),
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
        $bulletin = new Bulletin;

        $bulletin->category = $request->category;
        $bulletin->description = $request->descripiton;
        $bulletin->published = $request->published;
        $bulletin->date = $request->date;
        $bulletin->title = $request->title;
        $bulletin->content = $request->content;
        $bulletin->created_by = Auth()->user()->id;
        $bulletin->save();

        return redirect()->back();
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $bulletin = Bulletin::find($id);
        $bulletin->category = $request->category;
        $bulletin->description = $request->description;
        $bulletin->published = $request->published;
        $bulletin->date = $request->date;
        $bulletin->title = $request->title;
        $bulletin->content = $request->content;
        $bulletin->updated_by = Auth()->user()->id;

        if ($request->file('cover') != null) {
            $file = $request->file('cover')[0]['originFileObj'];

            $path = Storage::putFile('public/images/bulletin', $file);

            $bulletin->cover_image_path = $path;
        }

        $bulletin->save();
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
        $bulletin = Bulletin::where('id', $id)->first();

        $bulletin->delete();

        return redirect()->back();
        //
    }
}
