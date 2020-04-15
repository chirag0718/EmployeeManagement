<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 4/14/2020
 * Time: 3:46 PM
 */

namespace chirag\Employee\Console;

use chirag\Employee\EmployeeHistory;
use chirag\Employee\GeneralHelper;
use chirag\Employee\Provider\RequestProvider;
use Illuminate\Console\Command;

class DeleteEmpWebHistory extends Command
{
    protected $signature = "empwebhistory:softdelete {ip_address}";
    protected $description = "delete specific employee history data by ip address";

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
        $ip_address = $this->argument('ip_address');
        $senetizedIp = GeneralHelper::ipAddressSenetize($ip_address);
        if ($senetizedIp) {
            $this->info($senetizedIp);
            return;
        }
        $ip_exist = EmployeeHistory::getWebHistoryIpaddress($ip_address);
        if(!$ip_exist) {
            $this->info("Resource not found");
            return;
        }
        $headers = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ];
        $request = new RequestProvider("/employee-history/" . $ip_address, $headers);
        $response = $request->delete();
        dd($response);
    }
}
