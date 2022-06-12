<?php

namespace Tests\Feature;

use App\Models\GsOffice;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GsOfficeTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_gsOffices()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/gs-offices', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_gsOffice_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/gs-offices', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_gsOffice_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $gsOffice = GsOffice::factory(1)->makeOne()->toArray();
        $gsOffice['username'] = "test";
        $gsOffice['email'] = "test@test.com";
        $response = $this->postJson('api/gs-offices', $gsOffice);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_gsOffice()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $gsOffice = GsOffice::factory(1)->create()->first();
        $response = $this->get('api/gs-offices/' . $gsOffice->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_gsOffice_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $gsOffice = GsOffice::factory(1)->create()->first();
        $response = $this->putJson('api/gs-offices/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_gsOffice_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $gsOffice = GsOffice::factory(1)->create()->first();
        $response = $this->putJson('api/gs-offices/' . $gsOffice->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_gsOffice_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $gsOffice = GsOffice::factory(1)->create()->first();
        $gsOffice['username'] = "test";
        $gsOffice['email'] = "test@test.com";
        $response = $this->putJson('api/gs-offices/' . $gsOffice->id, $gsOffice->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_gsOffice_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/gs-offices/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_gsOffice_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $gsOffice = GsOffice::factory(1)->create()->first();
        $response = $this->delete('api/gs-offices/' . $gsOffice->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
