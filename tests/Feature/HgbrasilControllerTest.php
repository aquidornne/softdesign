<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\Services\HgbrasilService;

class HgbrasilControllerTest extends TestCase
{
    public function testWeather()
    {
        $response = $this->get('/weather');
        $response->assertStatus(200);

        $responseData = $response->json();

        $this->assertArrayHasKey('condition_slug', $responseData);
        $this->assertNotNull($responseData['condition_slug']);
    }
}