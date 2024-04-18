@extends('layouts.dashboard')
@section('title', 'Dashboard - Sale')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Sale</h1>
        </section>
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
                                    {{-- @if (Auth::user()->role == 'staff') --}}
                                    <a href="{{ route('sale.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus mr-2"></i>New
                                        Sale</a>
                                    {{-- @endif --}}
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
                                            <td>{{ $sale->total_price }}</td>
                                            <td>{{ $sale->user->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm"
                                                    data-target="exampleModal{{ $sale->id }}" data-toggle="modal"
                                                    data-bs-target="exampleModal{{ $sale->id }}"
                                                    data-bs-toggle="modal">Detail Sale</button>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('sale.download', ['id' => $sale->id]) }}">Download</a>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Customer Name: </div>
                    <div>Customer Address: </div>
                    <div>Customer Phone: </div>
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
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div>Total Price: Rp</div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
