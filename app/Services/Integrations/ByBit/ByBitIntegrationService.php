<?php

namespace App\Services\Integrations\ByBit;

use App\Models\Assets\Crypto;
use App\Services\Api\Command\CryptoUpdateMethod;
use Illuminate\Support\Arr;
use Lin\Bybit\BybitV5;

class ByBitIntegrationService implements ByBitIntegrationServiceContract
{
    protected string $key;


    protected string $secret;

    protected BybitV5 $bybitClient;

    protected $cryptoUpdateService;
    const ACCOUNT_TYPE = 'UNIFIED';

    const USD_TICKER = 'USDT';

    const DEFAULT_USDT_PRICE = 1;

    const TICKER_CATEGORY = 'spot';


    public function __construct(
        CryptoUpdateMethod $cryptoUpdateService
    )
    {
        $this->key = config('services.integrations.bybit.key');
        $this->secret = config('services.integrations.bybit.secret');
        $this->bybitClient = new BybitV5($this->key, $this->secret);
        $this->cryptoUpdateService = $cryptoUpdateService;
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

    public function syncCoins(): void
    {
        $walletData = $this->getWalletInfo();
        $coinsData = Arr::first($walletData['result']['list'])['coin'];

        foreach ($coinsData as $coinData) {

            $coinPriceData = $this->bybitClient->market()->getTickers([
                'category' => self::TICKER_CATEGORY,
                'symbol' => $coinData['coin'] . self::USD_TICKER
            ]);


            $price = $coinPriceData['retCode'] != 0 ? 0 :
                round(Arr::first($coinPriceData['result']['list'])['lastPrice'], 4);

            $price = $coinData['coin'] == self::USD_TICKER ? self::DEFAULT_USDT_PRICE : $price;

            Crypto::query()
                ->updateOrCreate(
                    [
                        'ticker' => $coinData['coin']
                    ],
                    [
                        'name' => $coinData['coin'],
                        'lots' => round($coinData['walletBalance'], 4),
                        'price' => $price
                    ]
                );
        }
    }
}
