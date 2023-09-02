<?php

namespace App\Http\Requests\Slider;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => 'required|min:2|string',
            'title_ar' => 'required|min:2|string',
            'description_en' => 'required|min:2',
            'description_ar' => 'required|min:2',
            'link' => 'required|string',
            'slider_img' => 'image|mimes:jpeg,jpg,png,gif|' . (request()->routeIs('admin.slider.store')? 'required' : 'nullable')
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ], 422));
    }
}

