<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Stock;

class AdminIndexController extends Controller
{
    public function index()
    {
        $names = Stock::query()->get();

        $labels = $names->pluck('name');

        $data = $names->pluck('total_price');

        return view('admin.admin_panel', compact('labels', 'data'));
    }
}
