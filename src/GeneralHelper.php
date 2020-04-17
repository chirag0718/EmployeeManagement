<?php

namespace chirag\Employee;
class GeneralHelper
{
    /**
     * Validating url
     */
    public static function urlSenetize($url)
    {
        if (!empty($url) && filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            return "Url format is invalid or passing empty parameter";
        }
        return null;
    }

    public static function ipAddressSenetize($ip_address)
    {
        if (!empty($ip_address) && filter_var($ip_address, FILTER_VALIDATE_IP) === FALSE) {
            return "IpAddress format is invalid or passing empty parameter";
        }
        return null;
    }
}
