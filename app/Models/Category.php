<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'icon',
        'gif',
        'name',
        'description',
        'cta_title',
        'cta_subtitle',
    ];

    public function fdtrcks(): HasMany
    {
        return $this->hasMany(Fdtrck::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gif')
            ->singleFile();

        $this->addMediaCollection('icon')
            ->singleFile();
    }
}
