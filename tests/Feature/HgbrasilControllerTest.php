<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\Services\HgbrasilService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HgbrasilControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testWeather()
    {
        $response = $this->get('/weather');
        $response->assertStatus(200);

        $responseData = $response->json();

        $this->assertArrayHasKey('condition_slug', $responseData);
        $this->assertNotNull($responseData['condition_slug']);
    }
}