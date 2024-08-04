<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Assets\Loan;

class AdminLoanController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $loans = Loan::query()->paginate($perPage, '*', 'page', $page);

        return view('admin.loans.loans', compact('loans'));
    }


    public function create()
    {
        return view('admin.loans.create');
    }


    public function store(LoanRequest $request)
    {
        $data = $request->validated();

        Loan::query()
            ->create($data);

        return redirect(route('admin.loans.index'));
    }

    public function edit(Loan $loan)
    {
        return view('admin.loans.edit', compact('loan'));
    }


    public function update(LoanRequest $request, Loan $loan)
    {
        $data = $request->validated();

        $loan->update($data);
        $loan->refresh();

        return redirect(route('admin.loans.index'));
    }


    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect(route('admin.loans.index'));
    }
}
