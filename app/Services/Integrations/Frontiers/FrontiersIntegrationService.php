<?php

namespace App\Services\Integrations\Frontiers;

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class FrontiersIntegrationService implements FrontiersIntegrationServiceContract
{
    const TOKEN_CACHE_TIME = 60 * 60;

    private string $url;

    public function __construct()
    {
        $this->url = config('services.integrations.frontiers.url');
    }

    public function getToken()
    {
        $settings = Settings::query()
            ->whereIn('key',[
                'frontiers_login',//todo в константы
                'frontiers_password',
            ])
            ->get();

        $url = $this->url;
        $loginData = [
            'login' => $settings->where('key', 'frontiers_login')->first()->value['value'],
            'password' => $settings->where('key', 'frontiers_password')->first()->value['value']
        ];

        $callback = static function () use ($url, $loginData) {
            $response = Http::asJson()->post(
                $url . 'api/users/login',
                $loginData
            );

            if($response->status() != '200') {
                dd('error');
            }

            return $response->json('token');
        };

        return Cache::tags(['integration','frontiers'])
        ->remember('token', self::TOKEN_CACHE_TIME, $callback);

    }

    public function getBalanceInfo(): array
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->get($this->url . 'api/users/me/balance');

        if ($response->status() != '200') {
            dd('error');
        }

        return [
          'total' => (float)$response->json('investor.totalInvestmentAmount'),
          'reserved' => (float)$response->json('investor.reserved'),
          'free' => (float)$response->json('investor.free'),
          'invested' => (float)bcsub(
              $response->json('investor.totalInvestmentAmount'),
              (float)$response->json('investor.reserved'),
              2
          )
        ];
    }
}
