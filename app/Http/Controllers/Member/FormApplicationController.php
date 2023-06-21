<?php

namespace App\Http\Controllers\Member;

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
        if (FormApplication::where('form_id', $form->id)->where('user_id', $user->id)->first()) {
            return redirect()->back()->withErrors(['message' => '你已報名此課程']);
        };
        $application = new FormApplication;

        $application->form_id = $form->id;
        $application->user_id = $user->id;

        $application->save();

        if ($request->fields) {
            foreach ($request->fields as $key => $f) {
                $field = new FormApplicationField;
                $field->application_id = $application->id;
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
        $form_fields = FormField::where('form_id', $application->form_id)->get();

        // dd($form_fields);
        return Inertia::render('Forms/ApplicationShow', [
            'application_fields' => $application_fields,
            'form_fields' => $form_fields,
            'application' => $application->with('form')->first(),
            'states' => Config::item('application_states'),
        ]);
    }
}
