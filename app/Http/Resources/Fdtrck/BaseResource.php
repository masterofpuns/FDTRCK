<?php

namespace App\Http\Resources\Fdtrck;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Models\Fdtrck
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'location' => [
                'lat' => $this->resource->lat,
                'lng' => $this->resource->lng,
            ],
            'phone' => $this->resource->phone,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'reviews' => [
                'score' => $this->resource->review_score,
                'count' => $this->resource->review_count,
            ],
            'image' => [
                'thumb' => $this->resource->getFirstMediaUrl('main', 'thumb') ?: null,
                'medium' => $this->resource->getFirstMediaUrl('main', 'medium') ?: null,
                'large' => $this->resource->getFirstMediaUrl('main', 'large') ?: null,
            ],
        ];
    }
}
