<?php

namespace chirag\Employee\Http\Controllers;

use chirag\Employee\Repositories\EmpWebHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EmpWebHistoryController extends Controller
{

    /**
     * @var EmpWebHistoryRepository
     */
    private $empWebHistoryRepository;

    /**
     * EmpWebHistoryController constructor.
     * @param EmpWebHistoryRepository $empWebHistoryRepository
     */
    public function __construct(EmpWebHistoryRepository $empWebHistoryRepository)
    {
        $this->empWebHistoryRepository = $empWebHistoryRepository;
    }

    /** Showing the web history for specific ip adddress
     * @param $ip_address
     * @return mixed
     */
    public function show($ip_address)
    {
        $employee = $this->empWebHistoryRepository->findByIpaddress($ip_address);
        return $employee;
    }

    /** Showing the all web histories
     * @return mixed
     */
    public function index()
    {
        $employee = $this->empWebHistoryRepository->getAll();
        return $employee;
    }

    /** Creating new web history
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required',
            'urls' => 'required',
        ]);
        $empWebHistoryData = $request->all();

        $employee = $this->empWebHistoryRepository->create($empWebHistoryData);
        return $employee;
    }

    /** Deleting specific web history
     * @param $ip_address
     * @return null
     */
    public function destroy($ip_address)
    {
        $this->empWebHistoryRepository->delete($ip_address);
        return "NULL";
    }
}