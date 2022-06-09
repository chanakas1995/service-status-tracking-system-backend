<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticate_user_without_username_or_password()
    {
        $response = $this->postJson('api/auth/login', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_authenticate_user_with_invalid_username()
    {
        $this->seed(UserSeeder::class);
        $credentials = ['username' => 'user', 'password' => 'user'];
        $response = $this->postJson('/api/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_authenticate_user_with_invalid_password()
    {
        $this->seed(UserSeeder::class);
        $credentials = ['username' => 'superadmin', 'password' => 'user'];
        $response = $this->postJson('/api/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_authenticate_user_with_valid_username_or_password()
    {
        $this->seed(UserSeeder::class);
        $credentials = ['username' => 'superadmin', 'password' => 'password'];
        $response = $this->postJson('/api/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_get_user_without_authentication()
    {
        $this->seed(UserSeeder::class);
        $response = $this->json('GET', '/api/auth/user', [], ['accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_get_user_with_authentication()
    {
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $response = $this->get('/api/auth/user');
        $response->assertStatus(Response::HTTP_OK);
    }
}
