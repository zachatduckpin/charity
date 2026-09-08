<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'photo' => asset('assets/images/' . $this->photo),
            'description' => $this->description,
            'category' => $this->category,
            'created_at' => $this->created_at->format('d M Y'),
            'comment_count' => $this->comments_count ? $this->comments_count : 0,
            'comments' => $this->comments ? $this->comments : [],

        ];
    }
}
