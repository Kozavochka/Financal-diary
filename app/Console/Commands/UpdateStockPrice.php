<?php

namespace App\Console\Commands;

use App\Services\Api\Command\StockPriceUpdateService;
use Illuminate\Console\Command;

class UpdateStockPrice extends Command
{

    protected $signature = 'stock:update';

    protected $description = 'Update stock price by MOEX API';

    protected $service;
    public function __construct(StockPriceUpdateService $service)
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
