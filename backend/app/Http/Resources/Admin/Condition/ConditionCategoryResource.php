<?php

namespace App\Http\Resources\Admin\Condition;

use App\Http\Resources\Admin\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ConditionCategoryResource extends JsonResource
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
            'key' => $this->key,
            'language' => new LanguageResource($this->language),
        ];
    }
}
