<?php

namespace App\Http\Resources\Admin\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyUserResource extends JsonResource
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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'avatar' => $this->avatar,
        ];
    }
}
