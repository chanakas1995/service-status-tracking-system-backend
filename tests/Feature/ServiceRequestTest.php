<?php

namespace Tests\Feature;

use App\Models\ServiceRequest;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ServiceRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_service_requests()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/service-requests', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_service_request_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/service-requests', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_service_request_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceRequest = ServiceRequest::factory(1)->makeOne()->toArray();
        $serviceRequest['username'] = "test";
        $serviceRequest['email'] = "test@test.com";
        $response = $this->postJson('api/service-requests', $serviceRequest);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_service_request()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceRequest = ServiceRequest::factory(1)->create()->first();
        $response = $this->get('api/service-requests/' . $serviceRequest->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_service_request_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceRequest = ServiceRequest::factory(1)->create()->first();
        $response = $this->putJson('api/service-requests/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_service_request_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceRequest = ServiceRequest::factory(1)->create()->first();
        $response = $this->putJson('api/service-requests/' . $serviceRequest->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_service_request_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceRequest = ServiceRequest::factory(1)->create()->first();
        $serviceRequest['username'] = "test";
        $serviceRequest['email'] = "test@test.com";
        $response = $this->putJson('api/service-requests/' . $serviceRequest->id, $serviceRequest->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_service_request_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/service-requests/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_service_request_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $serviceRequest = ServiceRequest::factory(1)->create()->first();
        $response = $this->delete('api/service-requests/' . $serviceRequest->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
