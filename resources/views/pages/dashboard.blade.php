@extends('layouts.dashboard')
@section('title', 'dashboard')
@section('content')
    <section>
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
    </section>
@endsection
