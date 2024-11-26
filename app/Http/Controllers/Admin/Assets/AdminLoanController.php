<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Jobs\Frontiers\SyncFrontiersLoansJob;
use App\Models\Assets\Loan;
use App\Models\Company;
use App\Services\Filters\Loan\LoanSearchFilter;
use App\Services\Integrations\Frontiers\FrontiersIntegrationServiceContract;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminLoanController extends Controller
{

    private $frontiersIntegrationService;
    public function __construct(FrontiersIntegrationServiceContract $frontiersIntegrationService)
    {
        $this->frontiersIntegrationService = $frontiersIntegrationService;
    }

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 20);

        $loans = QueryBuilder::for(Loan::class)
            ->with('company')
            ->allowedSorts([
                'price',
                'repayment_schedule_type',
                'payment_type'
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new LoanSearchFilter()),
                'repayment_schedule_type',
                'payment_type'
            ])
            ->defaultSorts('id')
            ->paginate($perPage, '*', 'page', $page);

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $days = Loan::query()->pluck('payment_day')->unique()->toArray();

        return view('admin.loans.loans', compact('loans', 'month', 'year', 'days'));
    }


    public function create()
    {
        $companies = Company::all();

        return view('admin.loans.create', compact('companies'));
    }


    public function store(LoanRequest $request)
    {
        Loan::query()
            ->create($request->validated());

        return redirect(route('admin.loans.index'));
    }

    public function edit(Loan $loan)
    {
        $companies = Company::all();

        return view('admin.loans.edit', compact('loan', 'companies'));
    }


    public function update(LoanRequest $request, Loan $loan)
    {
        $loan->update($request->validated());

        return redirect(route('admin.loans.index'));
    }


    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect(route('admin.loans.index'));
    }

    public function getFrontiers()
    {
        $frontiersData = $this->frontiersIntegrationService->getBalanceInfo();


        return view('frontiers.index', compact('frontiersData'));
    }

    public function syncFrontiersLoans()
    {
        SyncFrontiersLoansJob::dispatch();

        return redirect()->back();
    }
}
