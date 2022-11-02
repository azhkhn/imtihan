<?php

namespace App\Http\Requests\Admin\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyUserRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'passport_id' => 'required|numeric',
            'avatar' => 'string|max:255',
            'role' => 'integer',
        ];
    }
}
