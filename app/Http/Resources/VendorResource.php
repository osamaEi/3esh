<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            // 'categories' => $this->whenLoaded('categories', function() {
            //     return CategoryResource::collection($this->categories);
            // }),
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
