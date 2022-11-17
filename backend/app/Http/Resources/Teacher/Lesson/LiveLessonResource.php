<?php

namespace App\Http\Resources\Teacher\Lesson;

use Illuminate\Http\Resources\Json\JsonResource;

class LiveLessonResource extends JsonResource
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
            'name' => $this->name,
            'date' => $this->date,
            'url' => $this->url,
            'class_id' => $this->class_id,
            'question_category_id' => $this->question_category_id,
            'company_id' => $this->company_id,
        ];
    }
}
