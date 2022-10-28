<?php

namespace App\Http\Requests\Admin\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'tax_id' => 'required|integer|max:11',
            'email' => 'required|string|email|max:255',
            'web_url' => 'string|max:255',
            'phone' => 'required|string|max:255',
            'logo' => 'required|string',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'address' => 'required|string|max:600',
            'zip_code' => 'required|string|max:255',
        ];
    }
}
