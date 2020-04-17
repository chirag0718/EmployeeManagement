<?php

namespace chirag\Employee\Console;

use chirag\Employee\GeneralHelper;
use chirag\Employee\Provider\RequestProvider;
use chirag\Employee\Repositories\EmpWebHistoryRepository;
use Illuminate\Console\Command;

class GetEmpWebHistory extends Command
{
    protected $signature = "empwebhistory:get {ip_address}";
    protected $description = "get employee details from ip address";

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
    public function handle(EmpWebHistoryRepository $empWebHistoryRepository)
    {
        // Checking the inputs and their correct values
        $ip_address = $this->argument('ip_address');
        $senetizedIp = GeneralHelper::ipAddressSenetize($ip_address);
        if ($senetizedIp) {
            $this->info($senetizedIp);
            return;
        }

        $ip_exist = $empWebHistoryRepository->findByIpaddress($ip_address);
        if (!$ip_exist->count()) {
            $this->info("Resource not found");
            return;
        }

        // Passing the header information
        $headers = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ];
        // This will fetch the employee web history data
        $request = new RequestProvider("/employee-history/" . $ip_address, $headers);
        $response = $request->get();
        dd($response);
    }
}
