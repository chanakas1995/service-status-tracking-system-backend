<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\EmployeeSubjectRequest;
use App\Http\Resources\EmployeeSubjectResource;
use App\Models\Employee;
use App\Models\EmployeeSubject;
use App\Repositories\Contracts\EmployeeSubjectRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeSubjectController extends Controller
{
    private $employeeSubjectRepository;

    public function __construct(EmployeeSubjectRepositoryInterface $employeeSubjectRepository)
    {
        $this->employeeSubjectRepository = $employeeSubjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        $this->authorize('index_employee_subjects');
        return ResponseHelper::findSuccess("list", EmployeeSubjectResource::collection($employee->employeeSubjects->load('subject')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeSubjectRequest $request, Employee $employee)
    {
        $this->authorize('store_employee_subject');
        $data = $request->validated();
        $data['employee_id'] = $employee->id;
        return ResponseHelper::createSuccess("employeeSubject", new EmployeeSubjectResource($this->employeeSubjectRepository->store($data)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\EmployeeSubject  $employeeSubject
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, EmployeeSubject $employeeSubject)
    {
        $this->authorize('show_employee_subject');
        $employeeSubject->load('subject');
        return ResponseHelper::findSuccess("employeeSubject", new EmployeeSubjectResource($employeeSubject));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\EmployeeSubject  $employeeSubject
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeSubjectRequest $request, Employee $employee, EmployeeSubject $employeeSubject)
    {
        $this->authorize('update_employee_subject');
        return ResponseHelper::updateSuccess("employeeSubject", new EmployeeSubjectResource($this->employeeSubjectRepository->update($employeeSubject->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\EmployeeSubject  $employeeSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, EmployeeSubject $employeeSubject)
    {
        $this->authorize('destroy_employee_subject');
        return ResponseHelper::deleteSuccess("employeeSubject", $this->employeeSubjectRepository->delete($employeeSubject->id));
    }
}
