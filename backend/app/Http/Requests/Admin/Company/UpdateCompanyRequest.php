<?php

namespace App\Http\Requests\Admin\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'string|max:255',
            'subdomain' => 'string|max:255',
            'is_active' => 'boolean',
            'tax_id' => 'integer|max:11',
            'email' => 'string|email|max:255',
            'web_url' => 'string|max:255',
            'phone' => 'string|max:255',
            'logo' => 'string',
            'country_id' => 'numeric',
            'city_id' => 'numeric',
            'state_id' => 'numeric',
            'address' => 'string|max:600',
            'zip_code' => 'string|max:255',
        ];
    }
}
