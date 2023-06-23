<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Form;
use App\Models\FormApplication;
use App\Models\FormApplicationField;
use App\Models\FormField;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FormApplicationController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->per_page) {
            $per_page = 10;
        } else {
            $per_page = $request->per_page;
        }

        if ($request->form_id) {
            $applications = FormApplication::with('form', 'user', 'fields')->where('form_id', $request->id)->paginate($per_page);
        } else {
            $applications = FormApplication::with('form', 'user', 'fields')->paginate($per_page);
        }
        // dd(Config::item('bulletin_categories'));
        return Inertia::render('Admin/Application', [
            'applications' => $applications,
            'states' => Config::item('application_states'),
        ]);
    }

    public function store(Form $form, Request $request)
    {
    }

    public function show(FormApplication $application)
    {
        $application_fields = FormApplicationField::where('application_id', $application->id)->get();
        $form_fields = FormField::where('form_id', $application->form_id)->get();

        // dd($form_fields);
        return Inertia::render('Forms/ApplicationShow', [
            'application_fields' => $application_fields,
            'form_fields' => $form_fields,
            'application' => $application->with('form')->first(),
            'states' => Config::item('application_states'),
        ]);
    }
    public function changeState(FormApplication $application, Request $request)
    {
        if ($request->state) {
            $application->state = $request->state;
        }
        if ($request->remark) {
            $application->remark = $request->remark;
        }

        $application->save();

        return redirect()->back();
    }
}
