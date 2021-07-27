@extends('auth.layouts.main')

@section('title')
    <title>Login - SB Admin</title>
@endsection
@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Login</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}">
                <div class="form-floating mb-3">
                    <input class="form-control" id="phone_number" type="email" placeholder="name@example.com" />
                    <label for="phone_number">nomor telepon</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPassword" type="password" placeholder="Password" />
                    <label for="inputPassword">Password</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                    <label class="form-check-label" for="inputRememberPassword">Remember
                        Password</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="{{ route('password.request') }}">Forgot
                        Password?</a>
                    <a class="btn btn-primary" href="index.html">Login</a>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a>
            </div>
        </div>
    </div>
@endsection
