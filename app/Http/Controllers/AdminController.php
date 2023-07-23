<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('admin.index');
    }
}
