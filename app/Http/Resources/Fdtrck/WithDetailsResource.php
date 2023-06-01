<?php

namespace App\Http\Resources\Fdtrck;

use App\Http\Resources\Category\BaseResource as CategoryResource;
use App\Http\Resources\MenuItemResource;
use Illuminate\Http\Request;

class WithDetailsResource extends BaseResource
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
                'category' => CategoryResource::make($this->resource->category),
                'menu_items' => MenuItemResource::collection($this->resource->menuItems),
            ],
        );
    }
}
