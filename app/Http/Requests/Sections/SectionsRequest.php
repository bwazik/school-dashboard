<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;

class SectionsRequest extends FormRequest
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
            'name_ar' => 'required | max:50',
            'name_en' => 'required | max:50',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'teachers' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'name_ar.required' => trans('validation.required'),
            'name_ar.max' => trans('validation.max'),
            'name_en.required' => trans('validation.required'),
            'name_en.max' => trans('validation.max'),
            'grade_id.required' => trans('validation.required'),
            'classroom_id.required' => trans('validation.required'),
            'teachers.required' => trans('validation.required'),
        ];
    }
}
