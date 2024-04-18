@extends('layouts.dashboard')
@section('title', 'Dashboard - User')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>User</h1>
        </section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" novalidate class="needs-validation" action="{{ route('user.store') }}">
                        @csrf
                        <div class="card-header">
                            <h4>Input User</h4>
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
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <div class="invalid-feedback">
                                        Please fill in your password
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label for="">Role</label>
                                    <select class="form-control" name="role">
                                        <option disabled selected>Select Role</option>
                                        <option value="staff">Staff</option>
                                        <option value="admin">Admin</option>
                                    </select>
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
