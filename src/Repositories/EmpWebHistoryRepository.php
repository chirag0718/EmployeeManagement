<?php

namespace chirag\Employee\Repositories;

use chirag\Employee\EmployeeHistory;

class EmpWebHistoryRepository implements EmpWebHistoryRepositoryInterface
{

    /**
     * @var EmployeeHistory
     */
    private $model;

    /**
     * EmpWebHistoryRepository constructor.
     * @param EmployeeHistory $model
     */
    public function __construct(EmployeeHistory $model)
    {
        $this->model = $model;
    }

    /** fetching the all employee from db.
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->select('id','ip_address', 'urls')->get();
    }

    /**
     * @param $ip_address
     * @return mixed
     */
    public function getByIpAddress($ip_address)
    {
        return $this->model->where('ip_address',$ip_address);
    }

    /**
     * @param $ip_address
     * @return null | mixed
     */
    public function findByIpaddress($ip_address)
    {
        $employee = $this->model->selectRaw("id, ip_address, GROUP_CONCAT(CONCAT('url:', urls) SEPARATOR ', ') AS urls")->where("ip_address", $ip_address)->groupBy("ip_address")->get();
        if($employee) {
            return $employee;
        }
        return null;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $ip_address
     * @return bool
     */
    public function delete($ip_address)
    {
        $this->getByIpAddress($ip_address)->delete();

        return true;
    }
}

?>