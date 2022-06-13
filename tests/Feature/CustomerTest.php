<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_customers()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/customers', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_customer_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/customers', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_customer_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $customer = Customer::factory(1)->makeOne()->toArray();
        $customer['username'] = "test";
        $customer['email'] = "test@test.com";
        $response = $this->postJson('api/customers', $customer);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_customer()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $customer = Customer::factory(1)->create()->first();
        $response = $this->get('api/customers/' . $customer->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_customer_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $customer = Customer::factory(1)->create()->first();
        $response = $this->putJson('api/customers/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_customer_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $customer = Customer::factory(1)->create()->first();
        $response = $this->putJson('api/customers/' . $customer->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_customer_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $customer = Customer::factory(1)->create()->first();
        $customer['username'] = "test";
        $customer['email'] = "test@test.com";
        $response = $this->putJson('api/customers/' . $customer->id, $customer->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_customer_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/customers/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_customer_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $customer = Customer::factory(1)->create()->first();
        $response = $this->delete('api/customers/' . $customer->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
