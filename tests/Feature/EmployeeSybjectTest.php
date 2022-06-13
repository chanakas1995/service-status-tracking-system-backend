<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\EmployeeSubject;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EmployeeSubjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_employee_subjects()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employee = Employee::whereHas('employeeSubjects')->first();
        $response = $this->get('api/employees/' . $employee->id . '/employee-subjects/', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_employee_subject_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employee = Employee::whereHas('employeeSubjects')->first();
        $response = $this->postJson('api/employees/' . $employee->id . '/employee-subjects/', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_employee_subject_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employeeSubject = EmployeeSubject::factory(1)->makeOne();
        $response = $this->postJson('api/employees/' . $employeeSubject->employee_id . '/employee-subjects/', $employeeSubject->toArray());
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_employee_subject()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employeeSubject = EmployeeSubject::factory(1)->create()->first();
        $response = $this->get('api/employees/' . $employeeSubject->employee_id . '/employee-subjects/' . $employeeSubject->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_employee_subject_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employeeSubject = EmployeeSubject::factory(1)->create()->first();
        $response = $this->putJson('api/employees/' . $employeeSubject->employee_id . '/employee-subjects/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_employee_subject_with_invalid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employeeSubject = EmployeeSubject::factory(1)->create()->first();
        $response = $this->putJson('api/employees/' . $employeeSubject->employee_id . '/employee-subjects/' . $employeeSubject->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_employee_subject_with_valid_data()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employeeSubject = EmployeeSubject::factory(1)->create()->first();
        $response = $this->putJson('api/employees/' . $employeeSubject->employee_id . '/employee-subjects/' . $employeeSubject->id, $employeeSubject->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_employee_subject_with_invalid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/employees/45/employee-subjects/45');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_employee_subject_with_valid_id()
    {
        $this->seed(DatabaseSeeder::class);
        $this->be(User::first());
        $employeeSubject = EmployeeSubject::factory(1)->create()->first();
        $response = $this->delete('api/employees/' . $employeeSubject->employee_id . '/employee-subjects/' . $employeeSubject->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
