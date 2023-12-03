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

    protected $service;
    public function __construct(CryptoUpdateMethod $service)
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
