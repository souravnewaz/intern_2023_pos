<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query();
        $customers = Customer::get();

        if(request()->has('product_name')) {
            $products->where('name', 'LIKE', request()->get('product_name') . '%');
        }

        $products = $products->get();

        $sale = Sale::whereNull('paid_amount')->with('items.product')->first();

        return view('home', compact('products', 'sale', 'customers'));
    }
}
