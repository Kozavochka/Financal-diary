<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DirectionRequest;
use App\Models\Direction;
use Illuminate\Http\Request;

class AdminDirectionController extends Controller
{
    public function index()
    {

        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $directions = Direction::query()
            ->withCount(['stocks','bonds','funds','cryptos','loans'])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.directions.index', compact('directions'));

    }


    public function create()
    {
        return view('admin.directions.create');
    }


    public function store(DirectionRequest $request)
    {
        $data = $request->validated();

        Direction::query()
            ->create($data);

        return redirect(route('admin.directions.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit()
    {

    }


    public function update()
    {

    }


    public function destroy(Direction $direction)
    {
        $direction->delete();

        return redirect(route('admin.directions.index'));
    }
}
