<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_redirects_to_the_login_page(): void
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('filament.auth.login');
    }
}
