<?php

namespace chirag\Employee\Console;

use chirag\Employee\GeneralHelper;
use chirag\Employee\Provider\RequestProvider;
use chirag\Employee\QuickEmployee;
use Illuminate\Console\Command;

class CreateEmployeeCommand extends Command
{
    protected $signature = "employee:create {emp_id} {epm_name} {ip_address}";
    protected $description = "create new employee";

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
    public function handle()
    {
        // Getting the all argument
        $ip_address = $this->argument('ip_address');
        $emp_id = (int) $this->argument('emp_id');
        $emp_name = $this->argument('epm_name');
        $senetizedIp = GeneralHelper::ipAddressSenetize($ip_address);
        if ($senetizedIp) {
            $this->info($senetizedIp);
            return;
        }
        $ip_exist = QuickEmployee::getEmpIpaddress($ip_address);
        if ($ip_exist) {
            $this->info("This ip address is already exist");
            return;
        }
        if (!is_int($emp_id)) {
            $this->info("please pass the numeric value for emp id");
            return;
        }

        if (!is_string($emp_name)) {
            $this->info("please pass the string value for emp name");
            return;
        }

        $headers = [
            'form_params' => [
                'ip_address' => $ip_address,
                'emp_id' => $emp_id,
                'epm_name' => $emp_name,
            ],
        ];

        // Passing the form params to post method to create employee
        $request = new RequestProvider("/employee", $headers);
        $response = $request->post();
        //$this->line($response);
        //dd($response);
    }
}
