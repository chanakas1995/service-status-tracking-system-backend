<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\EmployeeTypeResource;
use App\Repositories\Contracts\EmployeeTypeRepositoryInterface;

class EmployeeTypeController extends Controller
{
    private $employeeTypeRepository;

    public function __construct(EmployeeTypeRepositoryInterface $employeeTypeRepository)
    {
        $this->employeeTypeRepository = $employeeTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_employee_types');
        return ResponseHelper::findSuccess("EmployeeTypes", EmployeeTypeResource::collection($this->employeeTypeRepository->index()));
    }
}
