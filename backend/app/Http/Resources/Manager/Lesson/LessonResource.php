<?php

namespace App\Http\Resources\Manager\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'id' => $this->lesson_id,
            'name' => $this->lesson->name,
            'content' => $this->lesson->content,
            'category_id' => $this->lesson->category_id,
            'language_id' => $this->lesson->language_id,
        ];
    }
}
