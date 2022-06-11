<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Employee;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\EmployeeTypeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_employees()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $response = $this->get('api/employees', []);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_employee_with_invalid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $response = $this->postJson('api/employees', []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_employee_with_valid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $employee = Employee::factory(1)->makeOne()->toArray();
        $employee['username'] = "test";
        $employee['email'] = "test@test.com";
        $response = $this->postJson('api/employees', $employee);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_view_employee()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $employee = Employee::factory(1)->create()->first();
        $response = $this->get('api/employees/' . $employee->id);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_employee_with_invalid_id()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $employee = Employee::factory(1)->create()->first();
        $response = $this->putJson('api/employees/54', []);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_employee_with_invalid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $employee = Employee::factory(1)->create()->first();
        $response = $this->putJson('api/employees/' . $employee->id, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_employee_with_valid_data()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $employee = Employee::factory(1)->create()->first();
        $employee['username'] = "test";
        $employee['email'] = "test@test.com";
        $response = $this->putJson('api/employees/' . $employee->id, $employee->toArray());
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_employee_with_invalid_id()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $response = $this->delete('api/employees/455');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_employee_with_valid_id()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(EmployeeTypeSeeder::class);
        $this->seed(EmployeeSeeder::class);
        $this->be(User::first());
        $employee = Employee::factory(1)->create()->first();
        $response = $this->delete('api/employees/' . $employee->id);
        $response->assertStatus(Response::HTTP_OK);
    }
}
