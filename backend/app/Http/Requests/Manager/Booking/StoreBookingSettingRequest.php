<?php

namespace App\Http\Requests\Manager\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingSettingRequest extends FormRequest
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
            'ignore_date' => 'required|date',
            'company_id' => 'required|numeric',
        ];
    }
}
