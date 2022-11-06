<?php

namespace App\Http\Resources\Manager\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionBugResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->question->name,
            'description' => $this->description,
            'question_id' => $this->question_id,
        ];
    }
}
