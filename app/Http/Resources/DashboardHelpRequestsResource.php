<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardHelpRequestsResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'type' => $this->type,
            'description' => $this->description,
            'location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'name' => $this->location_name,
                'distance' => $this->when(isset($this->distance), function() {
                    return round($this->distance, 2); // Round to 2 decimal places
                }),
            ],
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
