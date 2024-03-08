<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->latest()->get();
        $categories = Category::latest()->get();
        $customers = Customer::latest()->get();

        return view('cashier.index', compact('products', 'categories', 'customers'));
    }
}
