<?php

namespace App\Http\Resources\Teacher\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingSettingResource extends JsonResource
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
            'ignore_date' => $this->ignore_date,
            'company_id' => $this->company_id,
        ];
    }
}
