<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use App\Models\Income;
use App\Models\IncomeType;
use Illuminate\Http\Request;

class AdminIncomeController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $incomes = Income::query()
            ->with('income_type')
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.income.index', compact('incomes'));
    }

    public function create()
    {
        $incomeTypes = IncomeType::query()->get();

        return view('admin.income.create', compact('incomeTypes'));
    }


    public function store(IncomeRequest $request)
    {
        $data = $request->validated();

        Income::query()->create($data);

        return redirect()->route('admin.incomes.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
