<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Models\MenuItem
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
            'price' => $this->resource->price,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
        ];
    }
}
