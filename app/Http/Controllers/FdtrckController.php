<?php

namespace App\Http\Controllers;

use App\Http\Resources\Fdtrck\WithDetailsResource as FdtrckResource;
use App\Models\Fdtrck;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class FdtrckController extends Controller
{
    public function index(Request $request): Responsable
    {
        // Prepare query with eager loads
        $fdtrcks = Fdtrck::query()
            ->with(['menuItems', 'category']);

        // See if a specific category has been requested, if so, load only those
        if ($request->query->has('category_id')) {
            $categoryId = $request->query->get('category_id');

            // Ensure the category is an integer
            if (is_numeric($categoryId) && (int) $categoryId == $categoryId) {
                $fdtrcks = $fdtrcks->where('category_id', (int) $categoryId);
            }
        }

        // Retrieve and return the data
        return FdtrckResource::collection(
            $fdtrcks->get()
        );
    }

    public function show(Fdtrck $fdtrck): Responsable
    {
        return FdtrckResource::make(
            $fdtrck
        );
    }
}
