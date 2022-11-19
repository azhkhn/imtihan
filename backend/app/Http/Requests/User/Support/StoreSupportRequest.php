<?php

namespace App\Http\Requests\User\Support;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportRequest extends FormRequest
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
            'subject' => 'required|string',
            'message' => 'required|string',
            'is_active' => 'required|boolean',
            'user_id' => 'required|numeric|exists:users,id',
            'company_id' => 'required|numeric|exists:companies,id',
        ];
    }
}
