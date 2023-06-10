<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Stock;

class AdminIndexController extends Controller
{
    public function index()
    {
        return view('admin.admin_panel');
    }
}
