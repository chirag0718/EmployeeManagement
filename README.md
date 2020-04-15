# Employee Management

This project display the employee details and employee web history using running several command.

### Installing
```
{
    "require": {
        "chirag/employee": "dev-master"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/chirag0718/EmployeeManagement.git"
        }
    ]
}
```
## Migrate Database

Now we have installed the package successfully. Now we need to migrate some of tables for employee package. In the command line, run following command.
```
php artisan migrate
```

### Publish the package config

Next, we need to publish the employee config file to apply some of custom setting to run commnad to manage employee.

```
php artisan vendor:publish --tag=employee-config
```
You will now find the config file located in /config/employee-config.php

## Built With

* [Laravel Framework](https://github.com/laravel/laravel) - The laravel web framework used

## Authors

* **Chirag Patel** - [ChiragPatel](hhttps://github.com/chirag0718)
