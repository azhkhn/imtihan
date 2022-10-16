<?php

namespace App\Http\Requests\Admin\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
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
            'code' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ];
    }
}
