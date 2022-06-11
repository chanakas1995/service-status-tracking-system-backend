<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Notifications\CreateAccountNotification;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    private $userRepository;
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, UserRepositoryInterface $userRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_employees');
        return ResponseHelper::findSuccess("list", EmployeeResource::collection($this->employeeRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $this->authorize('store_employee');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->has('image_file') && $request->get('image_file') != null) {
                $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'employees');
            }
            $password = Str::random(8);
            $data['password'] = Hash::make($password);
            $user = $this->userRepository->store($data + ["name" => $request->get('first_name') . " " . $request->get('last_name')]);
            $data['user_id'] = $user->id;
            $employee = $this->employeeRepository->store($data);
            $user->syncRoles(["Employee"]);
            $user->notify(new CreateAccountNotification($password));
            DB::commit();
            return ResponseHelper::createSuccess("employee", new EmployeeResource($employee));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $this->authorize('show_employee');
        $employee->load('user');
        return ResponseHelper::findSuccess("employee", new EmployeeResource($employee));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $this->authorize('update_employee');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->has('image_file') && $request->get('image_file') != null) {
                $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'employees');
            }
            $this->userRepository->update($employee->user->id, $data + ["name" => $request->get('first_name') . " " . $request->get('last_name')]);
            $employee = $this->employeeRepository->update($employee->id,  $data);
            DB::commit();
            return ResponseHelper::updateSuccess("employee", new EmployeeResource($employee));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('destroy_employee');
        return ResponseHelper::deleteSuccess("employee", $this->employeeRepository->delete($employee->id));
    }
}
