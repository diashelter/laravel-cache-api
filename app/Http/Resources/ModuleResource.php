<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'identify' => $this->uuid,
            'lessons' => LessonResource::collection($this->whenLoaded('lessons'))
        ];
    }
}
