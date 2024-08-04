<?php

namespace App\Console\Commands;

use App\Services\Api\Command\CryptoUpdateMethod;
use Illuminate\Console\Command;

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
