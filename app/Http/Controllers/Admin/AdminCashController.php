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

}
