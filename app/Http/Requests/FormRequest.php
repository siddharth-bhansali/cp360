<?php

namespace App\Http\Requests;

use App\Models\Field;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Validation\Rule;

class FormRequest extends BaseFormRequest
{
    public function rules()
    {
        $fields = Field::all();

        $rules = [];
        foreach($fields as $field) {
            $current_rule[$field->name][] = 'required';

            switch($field->type) {
                case 'text':
                case 'password':
                    $current_rule[$field->name][] = 'string';
                    $current_rule[$field->name][] = 'max:255';
                    break;

                case 'number':
                    $current_rule[$field->name][] = 'numeric';
                    break;

                case 'email':
                    $current_rule[$field->name][] = 'email';
                    break;

                case 'checkbox':
                    $current_rule[$field->name][] = 'array';
                    break;
                case 'select':
                    $current_rule[$field->name][] = Rule::in($field->options);
                    break;
            }

            $rules[$field->name] = $current_rule[$field->name];
        }

        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}
