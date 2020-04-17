<?php


namespace chirag\Employee\Repositories;

/**
 * Interface EmployeeRepositoryInterface
 * @package chirag\Employee\Repositories
 */
interface EmployeeRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function findByIpaddress($id);

    public function create(array $attributes);

    public function delete($id);
}