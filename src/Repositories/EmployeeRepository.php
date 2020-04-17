<?php

namespace chirag\Employee\Repositories;

use chirag\Employee\QuickEmployee;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    /**
     * @var QuickEmployee
     */
    private $model;

    public function __construct(QuickEmployee $model)
    {
        $this->model = $model;
    }

    /** get all employee data
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->select('id', 'emp_id', 'epm_name', 'ip_address')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /** Retrieve specific employee details
     * @param $ip_address
     * @return null | mixed
     */
    public function findByIpaddress($ip_address)
    {
        $employee = $this->model->select('id', 'emp_id', 'epm_name', 'ip_address')->where('ip_address', $ip_address)->get();
        if ($employee->count()) {
            return $employee;
        }
        return null;
    }

    /**
     * Create new employee
     * @param array $attributes
     * @return mixed | boolean
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**Delete employee by id
     * @param $id
     * @return bool | boolean
     */
    public function delete($id)
    {
        $this->getById($id)->delete();

        return true;
    }
}

?>
