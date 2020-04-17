<?php


namespace chirag\Employee\Provider;

/**
 * Interface ServiceInterface
 * @package chirag\Employee\Provider
 */
interface ServiceInterface
{
    public function post();

    public function get();

    public function delete();

    public function patch();
}