<?php

namespace App\Console\Commands;

use App\Models\Crypto;
use App\Services\Api\Command\CryptoUpdateMethod;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Mockery\Exception;

class UpdateCryptoPrice extends Command
{

    protected $signature = 'crypto:update';


    protected $description = 'Update crypto price by using API';


    public function handle()
    {
        $crypto = new CryptoUpdateMethod();

        $crypto->update();

       dd('Update success');
    }
}
