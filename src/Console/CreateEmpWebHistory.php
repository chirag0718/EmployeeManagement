<?php
namespace chirag\Employee\Console;

use chirag\Employee\GeneralHelper;
use chirag\Employee\Provider\RequestProvider;
use chirag\Employee\QuickEmployee;
use Illuminate\Console\Command;

class CreateEmpWebHistory extends Command
{
    protected $signature = "empwebhistory:create {ip_address} {url}";
    protected $description = "create web history for employee";

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
        $ip_address = trim($this->argument('ip_address'));
        $url = $this->argument('url');
        $senetizedIp = GeneralHelper::ipAddressSenetize($ip_address);
        if ($senetizedIp) {
            $this->info($senetizedIp);
            return;
        }
        $senetizedUrl = GeneralHelper::urlSenetize($url);
        if ($senetizedUrl) {
            $this->info($senetizedUrl);
            return;
        }

        $ip_exist = QuickEmployee::getEmpIpaddress($ip_address);
        if(!$ip_exist) {
            $this->info("Resource not found");
            return;
        }

        $headers = [
            'form_params' => [
                'urls' => $url,
                'ip_address' => $ip_address
            ]
        ];
        $request = new RequestProvider("/employee-history",$headers);
        $response = $request->post();
        dd($response);
    }
}