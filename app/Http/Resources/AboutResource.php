<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * The resource instance.
     *
     * @var \App\Models\About
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
            'title' => $this->resource->title,
            'text' => $this->resource->text,
            'button_text' => $this->resource->button_text,
            'button_url' => $this->resource->button_url,
            'copyright_title' => $this->resource->copyright_title,
            'copyright_text' => $this->resource->copyright_text,
        ];
    }
}
