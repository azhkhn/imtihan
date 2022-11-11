<?php

namespace App\Http\Requests\Manager\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLiveLessonRequest extends FormRequest
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
            'date' => 'date',
            'url' => 'string|max:255',
            'class_id' => 'numeric|exists:class_rooms,id',
            'question_category_id' => 'numeric|exists:question_categories,id',
            'company_id' => 'numeric|exists:companies,id',
        ];
    }
}
