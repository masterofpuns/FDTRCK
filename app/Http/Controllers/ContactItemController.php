<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactItemResource;
use App\Models\ContactItem;
use Illuminate\Contracts\Support\Responsable;

class ContactItemController extends Controller
{
    public function __invoke(): Responsable
    {
        return ContactItemResource::collection(
            ContactItem::query()
                ->get()
        );
    }
}
