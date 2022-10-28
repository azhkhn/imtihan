<?php

namespace App\Http\Requests\Manager\Booking;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'description' => 'string',
            'date' => 'date',
            'is_active' => 'boolean',
            'teacher_id' => 'numeric',
            'user_id' => 'numeric',
            'company_id' => 'numeric',
        ];
    }
}
