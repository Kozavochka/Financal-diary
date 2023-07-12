<?php

namespace App\Console\Commands;

use App\Models\Crypto;
use App\Services\Api\Command\CryptoUpdate;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Mockery\Exception;

class UpdateCryptoPrice extends Command
{

    protected $signature = 'crypto:update';


    protected $description = 'Update crypto price by using API';


    public function handle()
    {
        CryptoUpdate::update();

       dd('Update success');
    }
}
