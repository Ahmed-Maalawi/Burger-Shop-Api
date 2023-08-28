<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name.en' => ['required', 'min:2', 'string',Rule::unique('categories', 'name->en')],
            'name.ar' => ['required', 'min:2', 'string',Rule::unique('categories', 'name->ar')] ,
//            'category_img' => ['image','mimes:jpeg,jpg,png,gif','max:10000', request()->routeIs('admin.category.store')? 'required' : 'nullable']
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ],422));
    }
}
