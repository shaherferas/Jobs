<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListJobsTest extends TestCase
{
    use RefreshDatabase;

    public function testListJobs()
    {
        $user = User::factory()->create();
        Job::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/jobs');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}
