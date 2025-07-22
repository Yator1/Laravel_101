<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'event_id' => $this->event_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Add nested user resource
            'attendee' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
