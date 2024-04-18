@extends('layouts.dashboard')
@section('title', 'Dashboard - Sale')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Sale</h1>
        </section>
        <div class="section-body">
            <form action="{{ route('sale.invoice') }}" method="post" novalidate class="needs-validation">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <div class="invalid-feedback">
                                    Please fill in your name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="phone">Customer Phone</label>
                                <input type="number" class="form-control" name="phone" id="phone" required>
                                <div class="invalid-feedback">
                                    Please fill in your phone
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="address">Customer Address</label>
                                <textarea type="text" class="form-control" name="address" id="address" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="productInputContainer">
                    <div class="card">
                        <div class="card-body">
                            <div class="row product-input">
                                <div class="form-group col-md-6 col-12">
                                    <label for="">Product</label>
                                    <select name="products[]" class="form-control">
                                        <option disabled selected>Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Quantity</label>
                                    <input type="number" name="quantities[]" class="form-control total-input" required>
                                    <div class="invalid-feedback">
                                        please fill in the quantity
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" onclick="addProductInput()">Add Product</button>
                    <button class="btn btn-success">Buy</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function addProductInput() {
            var productInputContainer = document.getElementById("productInputContainer")
            var newProductInput = productInputContainer.children[0].cloneNode(true)
            var newIndex = productInputContainer.children.length
            newProductInput.querySelectorAll("input").forEach(function(input) {
                input.value = ''
            })
            newProductInput.querySelector("select").name = 'products[' +
                newIndex + ']'
            productInputContainer.appendChild(newProductInput)
        }

        function removeProductInput(button) {
            var card = button.closest('.card')
            card.remove()
        }
    </script>
@endsection
