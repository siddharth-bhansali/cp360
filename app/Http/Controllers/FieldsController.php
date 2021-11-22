<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldsRequest;
use App\Models\Field;
use Illuminate\Http\Request;
use Str;

class FieldsController extends Controller
{
    public function create()
    {
        return view('fields.create')->with([
            'fields' => Field::all()
        ]);
    }

    public function store(FieldsRequest $request)
    {
        $input = $request->validated();

        if(!in_array($input['type'], config('settings.with_options'))) {
            $input['options'] = [];
        } else {
            $input['options'] = array_values(array_filter($input['options']));
        }

        $input['name'] = Str::lower($input['name']);

        Field::create($input);

        $request->session()->flash('success', 'Form field created successfully');

        return redirect(route('fields.create'));
    }

    public function edit(Field $field)
    {
        return view('fields.edit')->with([
            'field' => $field
        ]);
    }

    public function update(FieldsRequest $request, Field $field)
    {
        $input = $request->validated();

        if(!in_array($input['type'], config('settings.with_options'))) {
            $input['options'] = [];
        } else {
            $input['options'] = array_values(array_filter($input['options']));
        }

        $field->update($input);

        request()->session()->flash('success', 'Form field updated successfully');

        return redirect(route('fields.create'));
    }

    public function destroy(Field $field)
    {
        $field->delete();

        request()->session()->flash('success', 'Form field deleted successfully');

        return redirect(route('fields.create'));
    }
}
