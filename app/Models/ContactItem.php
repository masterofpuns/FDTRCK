<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'url',
        'icon',
        'is_button',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_button' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', static function (Builder $builder): void {
            $builder->orderBy('order', 'asc');
        });
    }
}
