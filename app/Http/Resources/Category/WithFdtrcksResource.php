<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Fdtrck\BaseResource as FdtrckResource;
use Illuminate\Http\Request;

class WithFdtrcksResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(
            parent::toArray($request),
            [
                'fdtrcks' => FdtrckResource::collection($this->resource->fdtrcks),
            ],
        );
    }
}
