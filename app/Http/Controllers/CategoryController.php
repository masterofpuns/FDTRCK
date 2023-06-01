<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\WithFdtrcksResource as CategoryResource;
use App\Models\Category;
use Illuminate\Contracts\Support\Responsable;

class CategoryController extends Controller
{
    public function index(): Responsable
    {
        return CategoryResource::collection(
            Category::query()
                ->with('fdtrcks')
                ->get()
        );
    }

    public function show(Category $category): Responsable
    {
        return CategoryResource::make(
            $category
        );
    }
}
