<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $form_data = $request->all();

        $val_data = Validator::make(
            $form_data,
            [
                'name' => 'required|min:2|max:50',
                'email' => 'required|email',
                'message' => 'required|min:5'
            ],
            [
                'name.required' => 'Il nome é un campo obbligatorio',
                'name.min' => 'Il nome deve contenere almeno :min caratteri',
                'name.max' => 'Il nome non deve contenere più di :max caratteri',

                'email.required' => 'La mail é un campo obbligatorio',
                'email.email' => 'La mail deve essere corretta',

                'message.required' => 'Il messaggio é un campo obbligatorio',
                'message.min' => 'Il messaggio deve contenere almeno :min caratteri',
            ]
        );

        if ($val_data->fails()) {
            $success = false;
            $errors = $val_data->errors();

            return response()->json(compact('success', 'errors'));
        }

        $lead = new Lead();
        $lead->fill($form_data);
        $lead->save();

        $success = true;

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($lead));

        return response()->json($success);
    }
}
