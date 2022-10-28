<?php

namespace App\Http\Resources\Manager\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'date' => $this->date,
            'is_active' => $this->is_active,
            'teacher_id' => $this->teacher_id,
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
        ];
    }
}
