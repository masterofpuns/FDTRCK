<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactItemResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Models\ContactItem
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
            'text' => $this->resource->text,
            'url' => $this->resource->url,
            'icon' => '0x'.$this->resource->icon,
            'is_button' => $this->resource->is_button,
        ];
    }
}
