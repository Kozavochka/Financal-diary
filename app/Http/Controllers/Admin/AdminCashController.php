<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use Illuminate\Http\Request;

class AdminCashController extends Controller
{
    public function index()
    {
        $cashes = Cash::all();

        return view('admin.cash.index', compact('cashes'));
    }

    public function create()
    {
        return view('admin.cash.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:cashes'
            ]);

        Cash::query()->create($data);

        return redirect(route('admin.cash.index'));
    }


    public function destroy(Cash $cash)
    {
        $cash->delete();

        return redirect(route('admin.cash.index'));
    }
}
