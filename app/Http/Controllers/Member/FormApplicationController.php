<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Form;
use App\Models\FormApplication;
use App\Models\FormApplicationField;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FormApplicationController extends Controller
{
    //
    public function index(Request $request)
    {
        $applications = FormApplication::with('form')->where('user_id', Auth()->user()->id)->get();
        // dd(Config::item('bulletin_categories'));
        return Inertia::render('Forms/Application', [
            'applications' => $applications,
            'states' => Config::item('application_states'),
        ]);
    }

    public function store(Form $form, Request $request)
    {
        $user = Auth()->user();

        $application = new FormApplication;

        $application->form_id = $form->id;
        $application->user_id = $user->id;

        $application->save();

        if ($request->fields) {
            foreach ($request->fields as $key => $f) {
                $field = new FormApplicationField;

                $field->field_id = $key;
                $field->value = $f;

                $field->save();
                // $field->
            }
        }

        return Inertia::render('Forms/ApplicationSuccess');
    }

    public function show(FormApplication $application)
    {
        $application_fields = FormApplicationField::where('application_id', $application->id)->get();
        return Inertia::render('Forms/ApplicationShow', [
            'application' => $application
        ]);
    }
}
