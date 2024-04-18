@extends('layouts.dashboard')
@section('title', 'Dashboard - Product')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Product</h1>
        </section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" novalidate class="needs-validation" enctype="multipart/form-data"
                        action="{{ route('product.store') }}">
                        @csrf
                        <div class="card-header">
                            <h4>Input Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <div class="invalid-feedback">
                                        Please fill in your name
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price" required>
                                    <div class="invalid-feedback">
                                        Please fill in your price
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="stock" required>
                                    <div class="invalid-feedback">
                                        Please fill in your stock
                                    </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                    <label for="">Upload Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <button class="btn btn-success">Create</button>
                                <a class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
