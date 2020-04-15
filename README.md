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

return [
        'api_path' => '/v1/api', // this is api call url, you can change as per your requirement.
        'website_url' => 'http://localhost/people_managment/public' // place url from env or direct
    ];
```


You will now find the config file located in /config/employee-config.php

## Command 
Employee Command
1 SET empdata [emp_id] [emp_name] [ip_address] equals to php artisan employee:create [emp_id] [emp_name] [ip_address] =  Insert the employee details to employee table with data emp_id, emp_name, ip_address.

2 GET empdata [ip_address] equals to php artisan employee:get  [ip_address]  
 Get the employee details having the ip_address

3 UNSET empdata [ip_address] equals to php artisan employee:softdelete [ip_address]
Soft delete the data  having the passed ip_address

4. SET empwebhistory [ip_address] [url]​ : php artisan empwebhistory:create [ip_address] [url]
It will first check if the ip address is assigned to any employee or not if the ip address is there then it will insert the url  variable [url] to the mapped  ip_address [ip_address], other with it will throw error.

5. GET empwebhistory [ip_address] ​: php artisan empwebhistory:get [ip_address]
Print out the employee details with his web search history  stored under the variable [ip_address]. Print NULL if that ip_address doesn’t have any data

6. UNSET empwebhistory [ip_address]​ : php artisan empwebhistory:softdelete [ip_address]
Delete all the web search history data mapped with ip_address.

```
Sample Command in Laravel - php artisan employee:create 1234 chiragpatel 192.168.2.23
````

## Testing 
PHPunit testing is place using testbench, you can use TestCase.php for reference.

## Built With

* [Laravel Framework](https://github.com/laravel/laravel) - The laravel web framework used

## Authors

* **Chirag Patel** - [ChiragPatel](hhttps://github.com/chirag0718)
