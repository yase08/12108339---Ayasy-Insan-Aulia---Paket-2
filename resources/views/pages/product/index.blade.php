@extends('layouts.dashboard')
@section('title', 'Dashboard - Product')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Product</h1>
        </section>
        @if (session('success'))
            <div class="alert alert-danger alert-dismissible show fade">
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
                        <h3>Product List</h3>
                        <div class="card-header-form">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ route('product.create') }}"><i
                                            class="fas fa-plus mr-2"></i>New
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price) }}</td>
                                        @if ($product->image == null)
                                            <td>No Image</td>
                                        @else
                                            <td><img src="{{ asset('images/' . $product->image) }}" width="50"></td>
                                        @endif
                                        <td>{{ $product->stock }}</td>
                                        <td class="text-center d-flex">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('product.edit', ['id' => $product->id]) }}"
                                                class="btn btn-primary">Edit</a>
                                            <button type="button" class="btn btn-success btn-sm"
                                                data-target="#exampleModal{{ $product->id }}" data-toggle="modal">Update
                                                Stock</button>
                                            <form action="{{ route('product.destroy', ['id' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($products as $product)
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal{{ $product->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">Update Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateStockForm" action="{{ route('product.updateStock', $product->id) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" required>
                                <div class="invalid-feedback">
                                    Please fill in your stock
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection

{{-- @section('scripts')
    <script>
        $('.btn-update-stock').on('click', function() {
            var productId = $(this).data('product-id');
            var formAction = $('#updateStockForm').attr('action').replace(':id', productId);
            $('#updateStockForm').attr('action', formAction);
            $('#exampleModal').modal('show');
        });
    </script>
@endsection --}}
