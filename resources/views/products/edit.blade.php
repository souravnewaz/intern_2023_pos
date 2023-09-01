@extends('layouts.app')
@section('title', 'Dashboard | ')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>Edit Product</h4>
                </div>
                <div>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">All Products</a> 
                </div>
            </div>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post">
                @CSRF
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock In</label>
                        <input type="number" class="form-control" name="stock_in" value="{{ $product->stock_in }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Out</label>
                        <input type="text" class="form-control" value="{{ $product->stock_out }}" disabled>
                    </div>
                </div>

                <img src="{{ asset($product->image) }}" alt="img" height="120" width="120" class="rounded">

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-dark">Update Product</button>
            </form>
        </div>
    </div>
</div>

@endsection