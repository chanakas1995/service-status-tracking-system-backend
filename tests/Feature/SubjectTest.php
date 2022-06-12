<?php

namespace Tests\Feature;

use App\Models\Subject;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_subjects()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/subjects', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_subject_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/subjects', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_subject_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $subject = Subject::factory(1)->makeOne()->toArray();
        $subject['username'] = "test";
        $subject['email'] = "test@test.com";
        $response = $this->postJson('api/subjects', $subject);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_subject()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $subject = Subject::factory(1)->create()->first();
        $response = $this->get('api/subjects/' . $subject->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_subject_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $subject = Subject::factory(1)->create()->first();
        $response = $this->putJson('api/subjects/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_subject_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $subject = Subject::factory(1)->create()->first();
        $response = $this->putJson('api/subjects/' . $subject->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_subject_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $subject = Subject::factory(1)->create()->first();
        $subject['username'] = "test";
        $subject['email'] = "test@test.com";
        $response = $this->putJson('api/subjects/' . $subject->id, $subject->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_subject_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/subjects/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_subject_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $subject = Subject::factory(1)->create()->first();
        $response = $this->delete('api/subjects/' . $subject->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
