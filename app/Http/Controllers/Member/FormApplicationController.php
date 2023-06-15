<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormApplication;
use App\Models\FormApplicationField;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FormApplicationController extends Controller
{
    //
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

        return Inertia::render('ApplicationSuccess');
    }
}
