<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DirectionNameEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\FundRequest;
use App\Models\Direction;
use App\Models\Fund;
use Illuminate\Http\Request;

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

        $data['direction_id'] = Direction::query()
            ->where('name', DirectionNameEnums::funds()->value)
            ->first()->id;

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
