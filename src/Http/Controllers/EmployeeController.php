<?php

namespace chirag\Employee\Http\Controllers;

use chirag\Employee\QuickEmployee;
use chirag\Employee\Rosources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{
    /**
     * @param Employee $quickEmployee
     * @return EmployeeResource
     */
    public function show($id): EmployeeResource
    {
        return new EmployeeResource(QuickEmployee::find($id));
    }

    /**
     * @return EmployeeResource
     */
    public function index(): EmployeeResource
    {
        return new EmployeeResource(QuickEmployee::paginate());
    }

    /**
     * @param Request $request
     * @return EmployeeResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required',
            'epm_name' => 'required',
            'ip_address' => 'required',
        ]);

        $quickemployee = QuickEmployee::create($request->all());
        return new EmployeeResource($quickemployee);
    }

    /**
     * @param Employee $quickemployee
     * @param Request $request
     * @return EmployeeResource
     */
    public function update(QuickEmployee $quickemployee, Request $request): EmployeeResource
    {
        $quickemployee->update($request->all());
        return new EmployeeResource($quickemployee);
    }

    /**
     * @param Employee $quickemployee
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(QuickEmployee $quickemployee, $id)
    {
        $quickemployee::find($id)->delete();
        return new EmployeeResource($quickemployee);
    }
}