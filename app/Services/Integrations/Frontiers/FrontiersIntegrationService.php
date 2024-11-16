<?php

namespace App\Services\Integrations\Frontiers;

use App\Enums\LoanPaymentTypeEnum;
use App\Enums\LoanRepaymentScheduleTypeEnum;
use App\Models\Assets\Loan;
use App\Models\Company;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class FrontiersIntegrationService implements FrontiersIntegrationServiceContract
{
    const TOKEN_CACHE_TIME = 3 * 60;

    CONST CURRENT_PAYED_STATUS = '40ce4cd6-518f-4fdf-baba-46e925243baf';

    CONST RETURNED_STATUS = 'f739d9ff-a5d5-402a-b0c9-21c781db910c';

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

            return $response->json('token');
        };

        return Cache::tags(['integration','frontiers'])
        ->remember('token', self::TOKEN_CACHE_TIME + random_int(1, 10), $callback);

    }

    public function getBalanceInfo(): array
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->get($this->url . 'api/users/me/balance');

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

    public function syncLoans(): void
    {
        //Принудительный сброс кэша
        Cache::tags('frontiers')->flush();

        $token = $this->getToken();
        $companyId = $this->getCompanyId();

        $investmentsResponse =  Http::withToken($token)
            ->get($this->url . 'api/projects/my/investments', [
                'companyId' => $companyId,
                'statusId' => self::CURRENT_PAYED_STATUS,

            ]);

        $data = $investmentsResponse->json();

        $companies = $this->syncCompanies(Arr::pluck($data,'borrower'));

        $this->syncLoansData($data, $companies);
    }

    private function getCompanyId(): string
    {
        $token = $this->getToken();
        $url = $this->url;

        $callback = static function () use ($token, $url) {
            $response = Http::withToken($token)
                ->get($url . 'api/companies/documents');

            return $response->json()[0]['companyId'];
        };

        return Cache::tags(['integration','frontiers'])
            ->remember('company_uuid', self::TOKEN_CACHE_TIME + random_int(1, 10), $callback);
    }

    private function syncCompanies(array $companiesData): Collection
    {
        $companiesCollection = collect();
        foreach ($companiesData as $companyData) {
            $companiesCollection->push(
                Company::query()
                    ->updateOrCreate(
                        [
                            'frontiers_uuid' => $companyData['id']
                        ],
                        [
                            'name' => $companyData['shortName']
                        ]
                    )
            )
            ;
        }

        return $companiesCollection;
    }

    private function syncLoansData(array $frontiersLoansData, Collection $companies): void
    {
        foreach ($frontiersLoansData as $frontiersLoanData) {

           Loan::query()
                ->updateOrCreate(
                    [
                        'frontiers_uuid' => $frontiersLoanData['id']
                    ],
                    [
                        'company_id' => $companies
                            ->where('frontiers_uuid', $frontiersLoanData['borrower']['id'])->first()?->id,
                        'price' => $frontiersLoanData['myInvestmentAmount'],

                        'percent' => round((float)$frontiersLoanData['loanRate'] * 100, 2),

                        'repayment_schedule_type' => $frontiersLoanData['scheduleType'] == 'MONTH' ?
                            LoanRepaymentScheduleTypeEnum::monthly()->label : LoanRepaymentScheduleTypeEnum::quarterly()->label,

                        'payment_type' => $frontiersLoanData['paymentType'] == 'COUPON' ?
                            LoanPaymentTypeEnum::coupon()->label : LoanPaymentTypeEnum::annuity()->label,

                        'payment_day' => Carbon::parse($frontiersLoanData['loanFundedAt'])?->day,

                        'expiration_date' => Carbon::parse($frontiersLoanData['loanDue'])
                    ]
                );
        }
    }

    public function syncReturnedLoans(): void
    {
        $token = $this->getToken();
        $companyId = $this->getCompanyId();

        $investmentsResponse =  Http::withToken($token)
            ->get($this->url . 'api/projects/my/investments', [
                'companyId' => $companyId,
                'statusId' => self::RETURNED_STATUS,

            ]);

        $this->syncReturnedLoansData($investmentsResponse->json());
    }

    private function syncReturnedLoansData(array $returnedLoansData): void
    {
        Loan::query()
            ->whereIn('frontiers_uuid', Arr::pluck($returnedLoansData, 'id'))
            ->delete();
    }
}
