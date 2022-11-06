<?php

namespace App\Http\Requests\Manager\LiveLesson;

use Illuminate\Foundation\Http\FormRequest;

class StoreLiveLessonRequest extends FormRequest
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
            'date' => 'required|date',
            'url' => 'required|string|max:255',
            'class_id' => 'required|numeric|exists:class_rooms,id',
            'question_category_id' => 'required|numeric|exists:question_categories,id',
            'company_id' => 'required|numeric|exists:companies,id',
        ];
    }
}
