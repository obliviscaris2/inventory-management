<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $warehouses = Warehouse::all();
        return view('admin.index',[

            'warehouses' => $warehouses,
        ]);
    }

    // public function dashboard()
    // {

    //     $totalProduct = Product::get()->count();
    //     $product = Product::all();
    //     // $unit = Unit::all();
    //     // $unitCount = Unit::get()->count();

    //     return view('dashboard',compact('totalProduct','product',));



    // }

    public function dashboard()
{
    $products = Product::all();
    $productCounts = [];

    foreach ($products as $product) {
        $product_name = $product->product_name;

        if (!isset($productCounts[$product_name])) {
            $productCounts[$product_name] = 1;
        } else {
            $productCounts[$product_name]++;
        }
    }

    $totalProduct = count($products);

    return view('dashboard', compact('totalProduct', 'productCounts'));
}

}
