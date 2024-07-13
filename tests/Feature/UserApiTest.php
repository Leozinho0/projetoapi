<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        return $token;
    }

    /** @test */
    public function it_should_list_all_users()
    {
        $token = $this->authenticate();

        User::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name', 'email', 'created_at', 'updated_at']
                     ]
                 ]);
    }

    /** @test */
    public function it_should_show_a_user()
    {
        $token = $this->authenticate();

        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'id' => $user->id,
                         'name' => $user->name,
                         'email' => $user->email,
                         'created_at' => $user->created_at->toJSON(),
                         'updated_at' => $user->updated_at->toJSON(),
                     ]
                 ]);
    }

    /** @test */
    public function it_should_return_unauthorized_without_token()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(401);
    }
}
