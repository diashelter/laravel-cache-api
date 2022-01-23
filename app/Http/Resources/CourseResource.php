<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'identify' => $this->uuid,
            'title' => $this->name,
            'description' => $this->description,
            'date' => $this->created_at,
            'modules' => ModuleResource::collection($this->whenLoaded('modules'))
        ];
    }
}
