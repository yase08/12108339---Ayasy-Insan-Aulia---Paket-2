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
                    <form method="post" novalidate
                        class="needs-validation">
                        @csrf
                        @method('PATCH')
                        <div class="card-header">
                            <h4>Edit Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        >
                                    <div class="invalid-feedback">
                                        Please fill in your name
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                        >
                                    <div class="invalid-feedback">
                                        Please fill in your price
                                    </div>
                                </div>
                                <button class="btn btn-success">Create</button>
                                <a href="{{ route('product') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
