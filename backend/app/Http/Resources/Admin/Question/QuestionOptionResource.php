<?php

namespace App\Http\Resources\Admin\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionOptionResource extends JsonResource
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
            'id' => $this->id,
            'description' => $this->description,
            'is_correct' => $this->is_correct,
            'question' => new QuestionResource($this->whenLoaded('question')),
            'src' => $this->src,
        ];
    }
}
