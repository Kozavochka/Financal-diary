<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DirectionNameEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Direction;
use App\Models\Loan;
use Illuminate\Http\Request;

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

        $data['direction_id'] = Direction::query()
            ->where('name', DirectionNameEnums::loans()->value)
            ->first()?->id;

        Loan::query()
            ->create($data);

        return redirect(route('admin.loans.index'));
    }


    public function show(Loan $loan)
    {
        //
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
