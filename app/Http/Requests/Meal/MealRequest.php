<?php

namespace App\Http\Requests\Meal;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class MealRequest extends FormRequest
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
            'name.en' => ['required', 'string', 'min:3'],
            'name.ar' => ['required', 'string', 'min:3'],
            'desc.en' => ['required', 'string', 'min:3'],
            'desc.ar' => ['required', 'string', 'min:3'],
            'price' => ['required', 'numeric',],
            'discount' => ['nullable', 'numeric'],
            'category_id' => ['required',Rule::exists('categories', 'id')],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'validation error',
            'errors' => $validator->errors()
        ], 422));
    }
}
