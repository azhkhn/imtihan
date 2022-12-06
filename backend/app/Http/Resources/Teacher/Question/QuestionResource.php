<?php

namespace App\Http\Resources\Teacher\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->question_id,
            'name' => $this->question->name,
            'description' => $this->question->description,
            'category_id' => $this->question->category_id,
            'is_image_option' => $this->question->is_image_option,
            'src' => $this->question->src,
            'language_id' => $this->question->language_id,
            'options' => $this->question->options,
        ];
    }
}
