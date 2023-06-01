<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    public function test_languages_are_returned(): void
    {
        $response = $this->get(route('api.languages'));

        $response->assertSuccessful()
            ->assertJson([
                'nl',
            ], true);
    }
}
