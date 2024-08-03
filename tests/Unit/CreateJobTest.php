<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateJobTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateJob()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/jobs', [
            'title' => 'Test Job',
            'description' => 'Test Description',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'Test Job',
                     'description' => 'Test Description',
                 ]);

        $this->assertDatabaseHas('jobs', [
            'title' => 'Test Job',
            'description' => 'Test Description',
        ]);
    }
}
