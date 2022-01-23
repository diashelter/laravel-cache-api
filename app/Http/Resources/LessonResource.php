<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'identify' => $this->uuid,
            'title' => $this->name,
            'video' => $this->video,
            'description' => $this->description,
            'date' => $this->created_at,
        ];
    }
}
