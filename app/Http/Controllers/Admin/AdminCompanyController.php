<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Spatie\QueryBuilder\QueryBuilder;

class AdminCompanyController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $companies = QueryBuilder::for(Company::class)
            ->withCount('loans')
            ->withCount('deposits')
            ->allowedSorts([
                'name',
            ])
            ->allowedFilters([
                'name',
            ])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.company.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(CompanyRequest $request)
    {
        Company::query()
            ->create($request->validated());

        return redirect(route('admin.company.index'));
    }


    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }


    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect(route('admin.company.index'));
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect(route('admin.company.index'));
    }

    public function show(Company $company)
    {
        return view('admin.company.show',compact('company'));
    }
}
