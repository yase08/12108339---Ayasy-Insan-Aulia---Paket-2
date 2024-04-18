@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="register-brand">
                        <img src="../assets/img/stisla-fill.svg" alt="logo" width="100"
                            class="shadow-light rounded-circle">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>Register</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" method="POST" action="{{ route('auth.register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">name</label>
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
                                    <label for="email">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <div class="invalid-feedback">
                                        Please fill in your password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
