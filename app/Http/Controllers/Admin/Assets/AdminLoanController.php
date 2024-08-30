<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Assets\Loan;
use App\Models\Company;
use App\Services\Filters\Loan\LoanSearchFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminLoanController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $loans = QueryBuilder::for(Loan::class)
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
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.loans.loans', compact('loans'));
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
        return view('admin.loans.edit', compact('loan'));
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
}
