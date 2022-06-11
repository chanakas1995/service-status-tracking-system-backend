<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticate_user_without_username_or_password()
    {
        $this->seed(DatabaseSeeder::class);
        $response = $this->postJson('api/auth/login', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_authenticate_user_with_invalid_username()
    {
        $this->seed(DatabaseSeeder::class);
        $credentials = ['username' => 'user', 'password' => 'user'];
        $response = $this->postJson('/api/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_authenticate_user_with_invalid_password()
    {
        $this->seed(DatabaseSeeder::class);
        $credentials = ['username' => 'superadmin', 'password' => 'user'];
        $response = $this->postJson('/api/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_authenticate_user_with_valid_username_or_password()
    {
        $this->seed(DatabaseSeeder::class);
        $credentials = ['username' => 'superadmin', 'password' => 'password'];
        $response = $this->postJson('/api/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_get_user_without_authentication()
    {
        $this->seed(DatabaseSeeder::class);
        $response = $this->json('GET', '/api/auth/user', [], ['accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_get_user_with_authentication()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('/api/auth/user');
        $response->assertStatus(Response::HTTP_OK);
    }
}
