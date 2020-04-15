<?php

namespace chirag\Employee\Http\Controllers;

use chirag\Employee\EmployeeHistory;
use chirag\Employee\Rosources\EmployeeHistoryResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use stdClass;

class EmpWebHistoryController extends Controller
{
    /**
     *
     * @param $id
     * @return EmployeeHistoryResource
     */
    public function show($id): EmployeeHistoryResource
    {
        $empHistoryArray = EmployeeHistory::selectRaw("id, ip_address, GROUP_CONCAT(CONCAT('url:', urls) SEPARATOR ', ') AS urls")->where("ip_address", $id)->groupBy("ip_address")->get();
        return new EmployeeHistoryResource($empHistoryArray);
    }

    /**
     * @return EmployeeHistoryResource
     */
    public function index(): EmployeeHistoryResource
    {
        return new EmployeeHistoryResource(EmployeeHistory::paginate());
    }


    /**
     * @param Request $request
     * @return EmployeeHistoryResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required',
            'urls' => 'required',
        ]);

        $employeeHistory = EmployeeHistory::create($request->all());
        return new EmployeeHistoryResource($employeeHistory);
    }

    /**
     * @param Employee History $employeeHistory
     * @param Request $request
     * @return EmployeeHistoryResource
     */
    // public function update(EmployeeHistory $employeeHistory, Request $request): EmployeeHistoryResource
    // {
    //     // $url = $request->get('urls');
    //     // $employeeHistory->update([
    //     //     'urls' => DB::raw("CONCAT(urls, 'url:" . $url . ",')")
    //     // ]);
    //     //return new EmployeeHistoryResource($employeeHistory);
    // }

    /**
     *
     * @param Employee History $employeeHistory
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employeHistory = EmployeeHistory::where('ip_address',$id);
        $employeHistory->delete();
    }
}