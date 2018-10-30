<?php

namespace App\Api\V1\Resources;

/**
 * Post resource to implement model into response.
 */
class PostResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
