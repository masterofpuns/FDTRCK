<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'nl',
        ]);
    }
}
