@extends('layouts.app')
@section('title', 'Products')

@section('content')

<div class="container">
    <div class="card my-2">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h4>Products</h4>
            </div>
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Add Product</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="img" height="64" width="64" class="rounded">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock_in }}</td>
                            <td>{{ $product->stock_out }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                <a href="{{ route('products.delete', $product->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@endsection