@extends('layouts.app')
@section('title', 'Add Product')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h4>Add Product</h4>
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
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock In</label>
                    <input type="number" class="form-control" name="stock_in">
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-dark">Add Product</button>
            </form>
        </div>
    </div>
</div>

@endsection