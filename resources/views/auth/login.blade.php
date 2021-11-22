@extends('index')

@section('document-title', 'Login')
@section('header-login', 'active')

@section('content')
    <div class="col-md-8 col-lg-6 mx-auto card shadow border-0 p-4">
        <h1 class="text-center">Login</h1>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-primary">Login</button>
            </div>
        </form>
    </div>
@endsection
