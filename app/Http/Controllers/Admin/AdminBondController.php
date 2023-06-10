<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BondRequest;
use App\Models\Bond;
use App\Models\Stock;
use Illuminate\Http\Request;

class AdminBondController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $bonds = Bond::query()
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.bonds.index', compact('bonds'));
    }


    public function create()
    {
        return view('admin.bonds.create');
    }


    public function store(BondRequest $request)
    {
        $data = $request->validated();

        Bond::query()
            ->create($data);

        return redirect(route('admin.bonds.index'));
    }

    public function show(Bond $bond)
    {
        //
    }


    public function edit(Bond $bond)
    {
        return view('admin.bonds.edit', compact('bond'));
    }


    public function update(BondRequest $request, Bond $bond)
    {
        $data = $request->validated();

        $bond->update($data);
        $bond->refresh();

        return redirect(route('admin.bonds.index'));
    }

    public function destroy(Bond $bond)
    {
        $bond->delete();

        return redirect(route('admin.bonds.index'));
    }
}
