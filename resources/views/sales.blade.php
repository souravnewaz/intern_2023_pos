@extends('layouts.app')
@section('title', 'Sales')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Sales</h4>
        </div>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Due</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                            <td>
                                <p class="m-0"><strong>Name:</strong> {{ $sale->customer->name }}</p>
                                <p class="m-0"><strong>Phone:</strong> {{ $sale->customer->phone }}</p>
                                <p class="m-0"><strong>Address:</strong> {{ $sale->customer->address }}</p>
                            </td>
                            <td>
                                @foreach ($sale->items as $item)
                                    <p class="m-0"><strong>Product:</strong> {{ $item->product->name }}</p>
                                    <p class="m-0"><strong>Price:</strong> ${{ $item->price }}</p>
                                    <p class="m-0"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                    <p class="m-0"><strong>Total Price:</strong> {{ $item->total_price }}</p>
                                    <hr>
                                @endforeach
                            </td>
                            <td>{{ $sale->subtotal }}</td>
                            <td>{{ $sale->paid_amount }}</td>
                            <td>{{ $sale->due_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-2">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
</div>


@endsection