<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_update()
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the created user
        $this->actingAs($user);

        // Update the profile
        $response = $this->patch('/profile', [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ]);

        // Assert the response status and database changes
        $response->assertStatus(302); // Redirect status
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name', 'email' => 'updatedemail@example.com']);
    }
}
