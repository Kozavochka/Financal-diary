<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\FundRequest;
use App\Models\Assets\Fund;

class AdminFundController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $funds = Fund::query()->paginate($perPage, '*', 'page', $page);

        return view('admin.funds.funds', compact('funds'));
    }

    public function create()
    {

        return view('admin.funds.create');
    }


    public function store(FundRequest $request)
    {
        $data = $request->validated();

        Fund::query()
            ->create($data);

        return redirect(route('admin.funds.index'));
    }


    public function show(Fund $fund)
    {
        //
    }


    public function edit(Fund $fund)
    {
        return view('admin.funds.edit', compact('fund'));
    }


    public function update(FundRequest $request, Fund $fund)
    {
        $data = $request->validated();

        $fund->update($data);
        $fund->refresh();

        return redirect(route('admin.funds.index'));
    }


    public function destroy(Fund $fund)
    {
        $fund->delete();

        return redirect(route('admin.funds.index'));
    }
}
