<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Contracts\Support\Responsable;

class AboutController extends Controller
{
    public function __invoke(): Responsable
    {
        return AboutResource::make(
            About::first()
        );
    }
}
