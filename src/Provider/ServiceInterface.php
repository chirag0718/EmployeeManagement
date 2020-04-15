<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 3/29/2020
 * Time: 3:00 PM
 */

namespace chirag\Employee\Provider;


interface ServiceInterface
{
    public function post();

    public function get();

    public function delete();

    public function patch();
}