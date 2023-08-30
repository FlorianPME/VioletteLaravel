<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganisationControllerTest extends TestCase
{
    /** @test */
    public function itListsOrganisations(): void
    {
        $response = $this->get('/api/organisations');

        $response->assertStatus(200);
        dd($response->json('data'));
    }
}
