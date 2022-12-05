<?php

namespace App\Http\Resources\Teacher\Exam;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassExamResource extends JsonResource
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
            'is_active' => $this->is_active,
            'categories' => $this->classExamCategories,
        ];
    }
}
