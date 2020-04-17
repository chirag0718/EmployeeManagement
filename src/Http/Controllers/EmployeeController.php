<?php

namespace chirag\Employee\Http\Controllers;

use chirag\Employee\Repositories\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{

    /**
     * @var EmployeeRepositoryInterface
     */
    private $employeeRepository;

    /**
     * EmployeeController constructor.
     * @param EmployeeRepositoryInterface $employeeRepository
     */
    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /** Fetching all employee details
     * @return mixed
     */
    public function index()
    {
        $employee = $this->employeeRepository->getAll();
        return $employee;
    }


    /** Fetching specific employee information.
     * @param $ip_address
     * @return mixed
     */
    public function show($ip_address)
    {
        $employee = $this->employeeRepository->findByIpaddress($ip_address);
        return $employee;
    }

    /** Creating new employee
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required',
            'epm_name' => 'required',
            'ip_address' => 'required',
        ]);

        $employeeData = $request->all();
        $employee = $this->employeeRepository->create($employeeData);
        return $employee;
    }

    /** Deleting the specific employee
     * @param $ip_address
     * @return null
     */
    public function destroy($ip_address)
    {
        $this->employeeRepository->delete($ip_address);
        return "NULL";
    }
}