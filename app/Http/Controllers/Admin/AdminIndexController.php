<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;

class AdminIndexController extends Controller
{
    public function index()
    {
//        $directions = Direction::query()->get();

        return view('admin.admin_panel');
    }
}
