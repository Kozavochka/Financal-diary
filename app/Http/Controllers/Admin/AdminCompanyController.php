<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Assets\Loan;
use App\Models\Company;
use App\Services\Filters\Company\CompanySearchFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminCompanyController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $companies = QueryBuilder::for(Company::class)
            ->withCount('loans')
            ->withSum('loans','price')
            ->allowedSorts([
                'name',
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new CompanySearchFilter())
            ])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.loans.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.loans.companies.create');
    }

    public function store(CompanyRequest $request)
    {
        Company::query()
            ->create($request->validated());

        return redirect(route('admin.company.index'));
    }


    public function edit(Company $company)
    {
        return view('admin.loans.companies.edit', compact('company'));
    }


    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect(route('admin.company.index'));
    }

    public function destroy(Company $company)
    {
        Loan::query()
            ->where('company_id', $company->id)
            ->delete();

        $company->delete();

        return redirect(route('admin.company.index'));
    }

    public function show(Company $company)
    {
        return view('admin.loans.companies.show',compact('company'));
    }
}
