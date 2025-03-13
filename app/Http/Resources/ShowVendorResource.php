<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowVendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'business_name' => $this->business_name,
            'email' => $this->email,
            'logo' => $this->logo ? url('storage/' . $this->logo) : null,
            // 'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'contact_person' => $this->contact_person,
            'branches' =>$this->branches->map(function($branch){

                return[
                    
                'name' => $branch->name,
                'address' => $branch->address,
                'latitude' => $branch->latitude,
                'longitude' => $branch->longitude,
                'phone' => $branch->phone,
                'email' => $branch->email,
                'photo' => url('storage/' .$branch->photo),
                'opening_time' => $branch->opening_time,
                'closing_time' => $branch->closing_time,
                'working_days' => $branch->working_days,
                'notes' => $branch->notes,
                
                ];

            })
         
        ];
    }
}
