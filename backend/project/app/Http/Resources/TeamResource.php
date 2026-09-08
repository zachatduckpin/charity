<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this->name,
            'designation' => $this->designation,
            'photo' => asset('assets/images/'.$this->photo),
            'is_feature' => $this->is_feature,
            'bio' => $this->bio,
            'phone' => $this->phone,
       ];
    }
}
