@extends('layouts.app')
@section('title', 'Home')

@section('content')

<div class="row p-4 border">
    <div class="col-12 col-lg-8 overflow-auto vh-100">
        <div class="row p-2">
            <div class="col-12 mb-1">
                <form class="row g-3">
                    <div class="col-11">
                        <input type="text" class="form-control" placeholder="Product Name" name="product_name" value="{{ request()->product_name }}">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mb-3">search</button>
                    </div>  
                </form>
            </div>
            @foreach ($products as $product)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                    <div class="card" style="width: 11rem;">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="product-img" height="140">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="card-title mb-0 h6">{{ ucwords($product->name) }}</span> <small>({{ $product->stock_in - $product->stock_out }})</small>
                                        </div>
                                        <h6 class="card-title">${{ $product->price }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('add_to_cart', $product->id) }}" class="btn btn-outline-dark btn-sm btn-block">Add</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-4 bg-light py-2 px-4 shadow-sm">
        <h4>Order Details</h4>
        @if($sale)
            <ul class="list-group">
                @foreach ($sale->items as $item)
                    <li class="list-group-item">
                        <img src="{{ asset($item->product->image) }}" height="64" width="64" alt="product-img">
                        <span class="h5">{{ ucwords($item->product->name) }}</span>
                        <a href="{{ route('delete_from_cart', $item->id) }}" class="btn btn-danger btn-sm">remove</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@endsection