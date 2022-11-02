<?php

namespace App\Http\Requests\Admin\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'content' => 'string',
            'category_id' => 'integer|exists:question_categories,id',
            'language_id' => 'integer|exists:languages,id',
        ];
    }
}
