<?php

namespace Tests\Feature\Api;

use App\Models\ContactItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_contacts_can_be_retrieved_in_correct_order(): void
    {
        $contact1 = ContactItem::factory()->order(100)->create();
        $contact2 = ContactItem::factory()->order(10)->button()->create();

        $response = $this->get(route('api.contact'));

        $response->assertSuccessful()
            ->assertJsonStructure([
                'data' => [[
                    'text',
                    'url',
                    'icon',
                    'is_button',
                ]],
            ])
            ->assertJsonPath('data.0', [
                'text' => $contact2->text,
                'url' => $contact2->url,
                'icon' => '0x'.$contact2->icon,
                'is_button' => $contact2->is_button,
            ])
            ->assertJsonPath('data.1', [
                'text' => $contact1->text,
                'url' => $contact1->url,
                'icon' => '0x'.$contact1->icon,
                'is_button' => $contact1->is_button,
            ]);
    }
}
