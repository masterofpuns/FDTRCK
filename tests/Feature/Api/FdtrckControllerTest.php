<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Fdtrck;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FdtrckControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $structure = [
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
        'category' => [
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
        ],
        'menu_items' => [[
            'id',
            'price',
            'name',
            'description',
        ]],
    ];

    public function test_fdtrck_overview_is_returned(): void
    {
        $category1 = Category::factory()->has(Fdtrck::factory()->count(2)->has(MenuItem::factory()->count(3)))->create();
        $category2 = Category::factory()->has(Fdtrck::factory()->has(MenuItem::factory()->count(3)))->create();

        $response = $this->get(route('api.fdtrcks.index'));

        $response->assertSuccessful()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data' => [$this->structure]]);
    }

    public function test_fdtrck_overview_can_be_filtered(): void
    {
        $category1 = Category::factory()->has(Fdtrck::factory()->count(2)->has(MenuItem::factory()->count(3)))->create();
        $category2 = Category::factory()->has(Fdtrck::factory()->has(MenuItem::factory()->count(3)))->create();

        $response = $this->get(route('api.fdtrcks.index', ['category_id' => $category2->getKey()]));

        $response->assertSuccessful()
            ->assertJsonCount(1, 'data')
            ->assertJsonStructure(['data' => [$this->structure]])
            ->assertJsonPath('data.0.category.id', $category2->getKey());
    }

    public function test_fdtrck_details_can_be_retrieved(): void
    {
        $fdtrck = Fdtrck::factory()->has(MenuItem::factory()->count(3))->create();

        $response = $this->get(route('api.fdtrcks.show', [$fdtrck]));

        $response->assertSuccessful()
            ->assertJsonStructure(['data' => $this->structure])
            ->assertJsonPath('data.id', $fdtrck->getKey());
    }
}
