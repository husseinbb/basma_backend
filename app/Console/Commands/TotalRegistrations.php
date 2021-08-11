<?php

namespace App\Console\Commands;

use App\Services\Customers\CustomerService;
use Illuminate\Console\Command;

class TotalRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-total-registrations';

    
    private $customerService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CustomerService $customerService)
    {
        parent::__construct();
        $this->customerService = $customerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->customerService->sendTotalRegistrations();
    }
}