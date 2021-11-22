<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequest;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();

        return view('forms.index')->with([
            'forms' => $forms
        ]);
    }

    public function create()
    {
        if(auth()->check()) {
            return redirect(route('forms.index'));
        } else {
            $fields = Field::all();

            return view('forms.create')->with([
                'fields' => $fields
            ]);
        }
    }

    public function store(FormRequest $request)
    {
        $input = $request->validated();

        Form::create([
            'fields' => $input
        ]);

        $request->session()->flash('success', 'Form submitted successfully');

        return redirect(route('forms.create'));
    }
}
