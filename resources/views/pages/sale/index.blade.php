@extends('layouts.dashboard')
@section('title', 'Dashboard - Sale')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Sale</h1>
        </section>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>success:</b>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>error:</b>
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Sale List</h3>
                        <div class="card-header-form">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a href="/dashboard/sale/export" class="btn btn-success my-3" target="_blank">Export to
                                        Excel</a>
                                    @if (Auth::user()->role == 'staff')
                                        <a href="{{ route('sale.create') }}" class="btn btn-primary"><i
                                                class="fas fa-plus mr-2"></i>New
                                            Sale</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Customer</th>
                                        <th>Sale Date</th>
                                        <th>Total Price</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sale->customer->name }}</td>
                                            <td>{{ $sale->sale_date }}</td>
                                            <td>{{ number_format($sale->total_price) }}</td>
                                            <td>{{ $sale->user->name }}</td>
                                            <td class="d-flex">
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#exampleModal{{ $sale->id }}">Show Detail</button>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('sale.download', ['id' => $sale->id]) }}"
                                                    target="_blank">Download</a>
                                                <form action="{{ route('sale.destroy', ['id' => $sale->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($sales as $sale)
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal{{ $sale->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Sale {{ $sale->id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>Customer Name: {{ $sale->detailSale->first()->sale->customer->name }}</div>
                        <div>Customer Address: {{ $sale->detailSale->first()->sale->customer->address }}</div>
                        <div>Customer Phone: {{ $sale->detailSale->first()->sale->customer->phone }}</div>
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
                                @foreach ($sale->detailSale as $item)
                                    <tr>
                                        <th>{{ $item->product->name }}</th>
                                        <td>{{ $item->amount }}</td>
                                        <td>Rp{{ number_format($item->product->price) }}</td>
                                        <td>Rp{{ number_format($item->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>Total Price: Rp{{ number_format($sale->total_price) }}</div>
                        <div>Paid Amount: Rp{{ number_format($sale->paid_amount) }}</div>
                        <div>Return: Rp{{ number_format($sale->paid_amount - $sale->total_price) }}</div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
