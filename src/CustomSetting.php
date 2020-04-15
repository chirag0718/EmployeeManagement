<?php

namespace chirag\Employee;
class CustomSetting
{
    /**
     * Get the currently set URI path for the Employee.
     *
     * @return string
     */
    public static function path()
    {
        return config('employeeconfig.api_path', 'api');
    }

    public static function website_url() {
        return config('employeeconfig.website_url', 'http://localhost'). config('employeeconfig.api_path', '/api');
    }
}