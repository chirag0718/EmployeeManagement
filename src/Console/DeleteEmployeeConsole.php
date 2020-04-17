<?php

namespace chirag\Employee\Console;

use chirag\Employee\GeneralHelper;
use chirag\Employee\Repositories\EmployeeRepository;
use Illuminate\Console\Command;
use chirag\Employee\Provider\RequestProvider;

class DeleteEmployeeConsole extends Command
{

    protected $signature = "employee:softdelete {ip_address}";
    protected $description = "delete specific employee by ip address";


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle(EmployeeRepository $employeeRepository)
    {
        // Checking the inputs and their correct values
        $ip_address = $this->argument('ip_address');
        $senetizedIp = GeneralHelper::ipAddressSenetize($ip_address);
        if ($senetizedIp) {
            $this->info($senetizedIp);
            return;
        }
        $ip_exist = $employeeRepository->findByIpaddress($ip_address);
        if (!$ip_exist) {
            $this->info("Resource not found");
            return;
        }

        // Passing the header information
        $headers = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ];
        $request = new RequestProvider("/employee/" . $ip_address, $headers);
        $response = $request->delete();
        dd($response);
    }
}



