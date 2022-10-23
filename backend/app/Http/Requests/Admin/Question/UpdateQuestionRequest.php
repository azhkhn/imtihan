<?php

namespace App\Http\Requests\Admin\Question;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'description' => 'string',
            'category_id' => 'numeric|exists:question_categories,id',
            'is_option' => 'numeric',
            'src' => 'string',
            'language_id' => 'numeric|exists:languages,id',
            'options' => 'array',
        ];
    }
}
