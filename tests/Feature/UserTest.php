<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_users()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/users', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_user_with_invalid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/users', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_user_with_valid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/users', [
            "name" => "John Doe",
            "username" => "john87",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_user()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $user = User::create([
            "name" => "John Doe",
            "username" => "john87",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response = $this->get('api/users/' . $user->id);
        $response->assertStatus(Response::HTTP_OK);
    }
    
    public function test_update_user_with_invalid_id()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $user = User::create([
            "name" => "John Doe",
            "username" => "john87",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response = $this->putJson('api/users/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_user_with_invalid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $user = User::create([
            "name" => "John Doe",
            "username" => "john87",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response = $this->putJson('api/users/' . $user->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_user_with_valid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $user = User::create([
            "name" => "John Doe",
            "username" => "john87",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response = $this->putJson('api/users/' . $user->id, [
            "name" => "John Doe",
            "username" => "john89",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_user_with_invalid_id()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/users/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_user_with_valid_id()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->be(User::first());
        $user = User::create([
            "name" => "John Doe",
            "username" => "john87",
            "email" => "john@example.com",
            "roles" => [Role::first()->uuid],
        ]);
        $response = $this->delete('api/users/' . $user->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
