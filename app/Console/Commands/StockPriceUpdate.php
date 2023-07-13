<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Services\Api\Command\StockPriceUpdateMethod;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class StockPriceUpdate extends Command
{

    protected $signature = 'stock:update';

    protected $description = 'Update stock price by MOEX API';


    public function handle()
    {
        StockPriceUpdateMethod::update();

        dd('Update success');
    }
}
