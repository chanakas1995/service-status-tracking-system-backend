<?php

namespace Tests\Feature;

use App\Models\ServiceType;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ServiceTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_serviceTypes()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/service-types', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_serviceType_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/service-types', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_serviceType_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceType = ServiceType::factory(1)->makeOne()->toArray();
        $serviceType['username'] = "test";
        $serviceType['email'] = "test@test.com";
        $response = $this->postJson('api/service-types', $serviceType);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_serviceType()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceType = ServiceType::factory(1)->create()->first();
        $response = $this->get('api/service-types/' . $serviceType->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_serviceType_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceType = ServiceType::factory(1)->create()->first();
        $response = $this->putJson('api/service-types/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_serviceType_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceType = ServiceType::factory(1)->create()->first();
        $response = $this->putJson('api/service-types/' . $serviceType->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_serviceType_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceType = ServiceType::factory(1)->create()->first();
        $serviceType['username'] = "test";
        $serviceType['email'] = "test@test.com";
        $response = $this->putJson('api/service-types/' . $serviceType->id, $serviceType->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_serviceType_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/service-types/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_serviceType_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceType = ServiceType::factory(1)->create()->first();
        $response = $this->delete('api/service-types/' . $serviceType->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
