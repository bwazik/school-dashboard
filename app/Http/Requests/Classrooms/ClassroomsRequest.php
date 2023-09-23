<?php

namespace App\Http\Requests\Classrooms;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomsRequest extends FormRequest
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
            'classrooms_list.*.name_ar' => 'required | max:50 | min:5',
            'classrooms_list.*.name_en' => 'required | max:50 | min:5',
            'classrooms_list.*.grade_id' => 'required',
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
            'grade_id.required' => trans('validation.required'),
        ];
    }

    
}
