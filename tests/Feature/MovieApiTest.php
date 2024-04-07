<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class MovieApiTest extends TestCase
{
    public function test_example(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs($user);

        // Access the endpoint
        $response = $this->get('/movies');

        // Assert the status
        $response->assertStatus(200);
    }
}
