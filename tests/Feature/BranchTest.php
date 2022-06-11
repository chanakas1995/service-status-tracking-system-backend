<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BranchTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_branches()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/branches', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_branch_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/branches', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_branch_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $branch = Branch::factory(1)->makeOne()->toArray();
        $branch['username'] = "test";
        $branch['email'] = "test@test.com";
        $response = $this->postJson('api/branches', $branch);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_branch()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $branch = Branch::factory(1)->create()->first();
        $response = $this->get('api/branches/' . $branch->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_branch_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $branch = Branch::factory(1)->create()->first();
        $response = $this->putJson('api/branches/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_branch_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $branch = Branch::factory(1)->create()->first();
        $response = $this->putJson('api/branches/' . $branch->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_branch_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $branch = Branch::factory(1)->create()->first();
        $branch['username'] = "test";
        $branch['email'] = "test@test.com";
        $response = $this->putJson('api/branches/' . $branch->id, $branch->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_branch_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/branches/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_branch_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $branch = Branch::factory(1)->create()->first();
        $response = $this->delete('api/branches/' . $branch->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
