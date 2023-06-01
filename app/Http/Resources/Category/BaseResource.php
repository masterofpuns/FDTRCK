<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Models\Category
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
            'id' => $this->resource->getKey(),
            'icon' => '0x'.$this->resource->icon,
            'icon_svg' => $this->resource->getFirstMediaUrl('icon') ?: '',
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'cta' => [
                'gif' => $this->resource->getFirstMediaUrl('gif') ?: null,
                'title' => $this->resource->cta_title,
                'subtitle' => $this->resource->cta_subtitle,
            ],
        ];
    }
}
