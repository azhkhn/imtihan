<?php

namespace App\Http\Resources\Manager\Exam;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'user' => $this->user,
            'total_question' => $this->total_question,
            'correct' => $this->correct_answer,
            'in_correct' => $this->in_correct,
            'blank' => $this->blank,
            'point' => $this->point,
            'categories' => $this->category,
            'created_at' => $this->created_at,
        ];
    }
}
