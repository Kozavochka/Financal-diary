<?php

namespace App\Services\Integrations\ByBit;

use App\Models\Assets\Crypto;
use Illuminate\Support\Arr;
use Lin\Bybit\BybitV5;

class ByBitIntegrationService implements ByBitIntegrationServiceContract
{
    protected string $key;


    protected string $secret;

    protected BybitV5 $bybitClient;

    const ACCOUNT_TYPE = 'UNIFIED';
    public function __construct()
    {
        $this->key = config('services.integrations.bybit.key');
        $this->secret = config('services.integrations.bybit.secret');
        $this->bybitClient = new BybitV5($this->key, $this->secret);
    }

    public function getWalletInfo() {

        $walletData = $this->bybitClient->account()->getWalletBalance([
            'accountType' => self::ACCOUNT_TYPE,
        ]);

        if ($walletData['retMsg'] != 'OK' ) {
            abort(500, $walletData['retCode']);
        }

        return $walletData;

    }

    public function syncCoins() {
        $walletData = $this->getWalletInfo();
        $coinsData = Arr::first($walletData['result']['list'])['coin'];

        foreach ($coinsData as $coinData) {
            Crypto::query()
                ->updateOrCreate(
                    [
                        'ticker' => $coinData['coin']
                    ],
                    [
                        'name' => $coinData['coin'],
                        'lots' => $coinData['walletBalance'],
                        'price' => 0
                    ]
                );
        }
    }
}
