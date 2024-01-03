<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\IndustryRequest;
use App\Models\Industry;

class AdminIndustryController extends Controller
{

    public function index()
    {

        $page = request('page', 1);
        $perPage = request('per_page', 10);


        $industries = Industry::query()
            ->withCount('stocks')
            ->paginate($perPage, '*', 'page', $page);


        return view('admin.industries.index', compact('industries'));

    }


    public function create()
    {
        return view('admin.industries.create');
    }


    public function store(IndustryRequest $request)
    {
        $data = $request->validated();

        Industry::query()
            ->create($data);

        return redirect(route('admin.industries.index'));
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();

        return redirect(route('admin.stocks.index'));
    }

}
