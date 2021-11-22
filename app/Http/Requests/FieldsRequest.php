<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldsRequest extends FormRequest
{
    public function validationData()
    {
        $data = parent::validationData();

        return array_merge($data, [
            'options' => array_values(array_filter($data['options'])),
        ]);
    }

    public function rules()
    {
        $options_needed = in_array($this->input('type'), config('settings.with_options'));

        if($options_needed) {
            $options_rules = ['required', 'array', 'between:1,6'];
            $item_rules = ['required', 'string', 'max:255'];
        } else {
            $options_rules = ['nullable'];
            $item_rules = ['nullable'];
        }

        return [
            'label' => [
                'required',
                'string',
                'max: 255'
            ],
            'name' => [
                'required',
                'alpha_num',
                'max: 255'
            ],
            'type' => [
                'required',
                'string',
                'max: 255'
            ],
            'options' => $options_rules,
            'options.*' => $item_rules,
            'comment' => [
                'nullable',
                'string',
                'max:255'
            ]
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'options.*.required' => 'The options field is required.',
            'options.*.string' => 'Each option must be a string.',
            'options.*.max' => 'Each option must be a less than 255 characters long.',
        ];
    }
}
