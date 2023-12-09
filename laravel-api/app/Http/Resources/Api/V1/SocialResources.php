<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResources extends JsonResource
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
            'social' => $this->social,
            'url' => $this->url,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'restaurant' => new RestaurantResources($this->whenLoaded('restaurant')),
        ];
    }
}
