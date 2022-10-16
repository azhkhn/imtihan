<?php

namespace App\Http\Resources\Admin\Condition;

use Illuminate\Http\Resources\Json\JsonResource;

class ConditionResource extends JsonResource
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
            'question_category_id' => $this->question_category_id,
            'condition_category_id' => $this->condition_category_id,
            'value' => $this->value,
            'is_active' => $this->is_active,
        ];
    }
}
