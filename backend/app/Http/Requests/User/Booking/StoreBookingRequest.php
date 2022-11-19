<?php

namespace App\Http\Requests\User\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'description' => 'required|string',
            'date' => 'required|date',
            'is_active' => 'required|boolean',
            'teacher_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'company_id' => 'nullable',
        ];
    }
}
