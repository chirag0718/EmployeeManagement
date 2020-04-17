<?php

namespace chirag\Employee\Repositories;


interface EmpWebHistoryRepositoryInterface
{
    public function getAll();

    public function getByIpAddress($id);

    public function findByIpaddress($id);

    public function create(array $attributes);

    public function delete($id);
}