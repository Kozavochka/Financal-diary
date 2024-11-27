<?php

namespace App\Console\Commands;

use App\Services\Api\Command\CryptoPriceUpdateService;
use Illuminate\Console\Command;

class UpdateCryptoPrice extends Command
{

    protected $signature = 'crypto:update';


    protected $description = 'Update crypto price by using API';

    protected $service;
    public function __construct(CryptoPriceUpdateService $service)
    {
        parent::__construct();

        $this->service = $service;
    }
    public function handle()
    {
        $this->service->update();

        return Command::SUCCESS;
    }
}
