<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();

        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'phone' => 'required|string|min:9|max:13|unique:customers,phone',
            'address' => 'nullable|string|max:500'
        ]);

        Customer::create($input);

        return redirect()->back()->with('success', 'Customer Added Successfully');
    }
}
