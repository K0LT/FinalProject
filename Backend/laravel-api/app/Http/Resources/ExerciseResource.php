<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'description'      => $this->description,
            'category'         => $this->category,
            'difficulty_level' => $this->difficulty_level,
            'instructions'     => $this->instructions,
            'benefits'         => $this->benefits,
            'precautions'      => $this->precautions,
            'video_url'        => $this->video_url,
            'image_url'        => $this->image_url,
        ];
    }
}
