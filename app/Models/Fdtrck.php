<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Fdtrck extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slogan',
        'description',
        'phone',
        'lat',
        'lng',
        'review_score',
        'review_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'review_score' => 'float',
        'review_count' => 'integer',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $conversions = [
            'thumb' => [160, 160],
            'medium' => [720, 720],
            'large' => [1200, 1200],
        ];

        foreach ($conversions as $name => $sizes) {
            $this->addMediaConversion($name)
                ->performOnCollections('main')
                ->fit(Manipulations::FIT_CROP, $sizes[0], $sizes[1]);
        }
    }
}
