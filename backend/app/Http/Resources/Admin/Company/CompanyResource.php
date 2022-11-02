<?php

namespace App\Http\Resources\Admin\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'subdomain' => $this->subdomain,
            'is_active' => $this->is_active,
            'tax_id' => $this->tax_id,
            'email' => $this->email,
            'web_url' => $this->web_url,
            'phone' => $this->phone,
            'logo' => $this->logo,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'state_id' => $this->state_id,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
        ];
    }
}
