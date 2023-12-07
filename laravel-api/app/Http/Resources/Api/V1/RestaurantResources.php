<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResources extends JsonResource
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
            'fantasy_name' => $this->fantasy_name,
            'company_name' => $this->company_name,
            'identification' => $this->identification_doc,
            'describe' => $this->describe,
            'address' => $this->address,
            'opening_hours' => $this->opening_hours,
            'Categories' => CategoryResources::collection($this->whenLoaded('restaurantCategory')),
            'Socials' => SocialResources::collection($this->whenLoaded('restaurantSocial')),
            'Contacts' => ContactResources::collection($this->whenLoaded('restaurantCategory')),
        ];
    }
}
