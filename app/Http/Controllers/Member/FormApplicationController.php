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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormApplicationController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth()->user();
        $perPage = 10;
        if ($request->per_page != null) {
            $perPage = $request->per_page;
        }

        if ($request->category == 'all' || $request->category == null) {
            $applications = FormApplication::with('form')->where('user_id', $user->id)->paginate($perPage);
        } else if ($request->category == 'wait') {
            $applications = FormApplication::with('form')->where('user_id', $user->id)->where('state', 1)->paginate($perPage);
        } else if ($request->category == 'payment') {
            $applications = FormApplication::with('form')->where('user_id', $user->id)->where('state', 2)->paginate($perPage);
        } else if ($request->category == 'result') {
            $applications = FormApplication::with('form')->where('user_id', $user->id)->where('state', 4)->orWhere('state', 3)->paginate($perPage);
        }
        // dd(Config::item('bulletin_categories'));
        return Inertia::render('Forms/Application', [
            'applications' => $applications,
            'category' => $request->category ?? 'all',
            'states' => Config::item('application_states'),
            'states_message' => Config::item('states_messages'),
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
                $field->form_application_id = $application->id;
                $field->field_id = $key;
                $field->value = $f;

                $field->save();
            }
        }

        return Inertia::render('Forms/ApplicationSuccess');
    }

    public function show(FormApplication $application)
    {
        if ($application->user_id !== Auth()->user()->id) {
            return to_route('applications.index');
        }
        $application_fields = FormApplicationField::where('form_application_id', $application->id)->get();
        $form_fields = FormField::where('form_id', $application->form_id)->get();

        // dd($form_fields);
        return Inertia::render('Forms/ApplicationShow', [
            'application_fields' => $application_fields,
            'form_fields' => $form_fields,
            'application' => $application->with('form')->first(),
            'states' => Config::item('application_states'),
        ]);
    }

    public function uploadPaymentImage(FormApplication $application, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['message' => '請選擇你的繳費單']);
        }
        $file = $request->file('payment')[0]['originFileObj'];

        $path = Storage::putFile('public/images/payment', $file);

        $application->images_path = $path;
        $application->state = 2;
        $application->save();

        return redirect()->back();
    }
}
