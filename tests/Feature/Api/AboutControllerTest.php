<?php

namespace Tests\Feature\Api;

use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_data_is_returned(): void
    {
        $about = About::factory()->create();

        $response = $this->get(route('api.about'));

        $response->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'text',
                    'button_text',
                    'button_url',
                    'copyright_title',
                    'copyright_text',
                ],
            ])
            ->assertJsonFragment(['title' => $about->title]);
    }
}
