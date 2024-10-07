<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numQuestions' => 'required|integer|min:1|max:49',
            'difficulty' => 'required|string',
            'type' => 'nullable|string', // Type is optional
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->route('form.show')
                ->withErrors($validator)
                ->withInput();
        }

        // Handle successful validation (e.g., save data, send email, etc.)
        // For now, let's just return a success message
        return redirect()->route('form.show')->with('success', 'Form submitted successfully!');
    }
}
