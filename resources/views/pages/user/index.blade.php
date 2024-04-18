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
                    <div class="card-header d-flex justify-content-between">
                        <h3>User List</h3>
                        <div class="card-header-form">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ route('user.create') }}"><i
                                            class="fas fa-plus mr-2"></i>New
                                        User</a>
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-warning btn-sm "
                                                href="{{ route('user.edit', ['id' => $user->id]) }}"
                                                class="btn btn-primary">Edit</a>
                                            <div>
                                                <form action="{{ route('user.destroy', ['id' => $user->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                </form>
                                            </div>
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
@endsection
