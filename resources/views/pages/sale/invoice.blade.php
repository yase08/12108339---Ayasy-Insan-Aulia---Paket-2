@extends('layouts.dashboard')
@section('title', 'Dashboard - Invoice')
@section('content')
    <div class="card">
        <div class="card-header">
            Invoice
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <div>Customer Name: {{ $data['name'] }}</div>
                    <div>Customer Address: {{ $data['address'] }}</div>
                    <div>Customer Phone: {{ $data['phone'] }}</div>
                </div>
                <a href="/dashboard/sale/pdf" class="btn btn-primary h-100" target="_blank">Export PDF</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailSale as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['subtotal'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-3">Total Price: Rp {{ $totalPrice }}</div>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-primary">Cancel</a>
                <form action="{{ route('sale.store') }}" method="post">
                    @csrf
                    <button class="btn btn-primary" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
