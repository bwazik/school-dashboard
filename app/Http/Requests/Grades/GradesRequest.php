<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class GradesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar' => 'required | max:50 | min:5 | unique:grades,name->ar,'.$this -> id,
            'name_en' => 'required | max:50 | min:5 | unique:grades,name->en,'.$this -> id,
            'note' => 'max:120',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => trans('validation.required'),
            'name_ar.max' => trans('validation.max'),
            'name_ar.min' => trans('validation.min'),
            'name_ar.unique' => trans('validation.unique'),
            'name_en.required' => trans('validation.required'),
            'name_en.max' => trans('validation.max'),
            'name_en.min' => trans('validation.min'),
            'name_en.unique' => trans('validation.unique'),
            'note.max' => trans('validation.max'),
        ];
    }
}
