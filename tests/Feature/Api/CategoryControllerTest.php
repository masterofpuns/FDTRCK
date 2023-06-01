<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Fdtrck;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $structure = [
        'id',
        'icon',
        'icon_svg',
        'name',
        'description',
        'cta' => [
            'gif',
            'title',
            'subtitle',
        ],
        'fdtrcks' => [[
            'id',
            'location' => [
                'lat',
                'lng',
            ],
            'phone',
            'name',
            'description',
            'reviews' => [
                'score',
                'count',
            ],
            'image' => [
                'thumb',
                'medium',
                'large',
            ],
        ]],
    ];

    public function test_category_overview_is_returned(): void
    {
        $category = Category::factory()->has(Fdtrck::factory()->has(MenuItem::factory()->count(3)))->create();

        $response = $this->get(route('api.categories.index'));

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => [$this->structure]])
            ->assertJsonPath('data.0.id', $category->getKey())
            ->assertJsonPath('data.0.fdtrcks.0.id', $category->fdtrcks->first()->getKey());
    }

    public function test_category_details_are_returned(): void
    {
        $category = Category::factory()->has(Fdtrck::factory()->has(MenuItem::factory()->count(3)))->create();

        $response = $this->get(route('api.categories.show', [$category]));

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => $this->structure])
            ->assertJsonPath('data.id', $category->getKey())
            ->assertJsonPath('data.fdtrcks.0.id', $category->fdtrcks->first()->getKey());
    }
}
