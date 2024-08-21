<?php

namespace App\Console\Commands;

use App\Services\Api\Command\StockPriceUpdateMethod;
use Illuminate\Console\Command;

class UpdateStockPrice extends Command
{

    protected $signature = 'stock:update';

    protected $description = 'Update stock price by MOEX API';

    protected $service;
    public function __construct(StockPriceUpdateMethod $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    public function handle()
    {

        $this->service->update();

        dd('Update success');
    }
}
