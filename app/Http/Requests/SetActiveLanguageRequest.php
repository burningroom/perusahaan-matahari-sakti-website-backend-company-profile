<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetActiveLanguageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'max:10',
                'exists:languages,code'
            ]
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Language code is required.',
            'code.string' => 'Language code must be a string.',
            'code.max' => 'Language code must not exceed 10 characters.',
            'code.exists' => 'The selected language code does not exist.'
        ];
    }
}