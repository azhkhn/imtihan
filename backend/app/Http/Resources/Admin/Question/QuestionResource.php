<?php

namespace App\Http\Resources\Admin\Question;

use App\Http\Resources\Admin\LanguageResource;
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => new QuestionCategoryResource($this->category),
            'is_image_option' => $this->is_image_option,
            'options' => QuestionOptionResource::collection($this->options),
            'src' => $this->src,
            'language' => new LanguageResource($this->language),
        ];
    }
}
