@extends('user,auth.layouts.main')

@section('title')
    <title>Login - SB Admin</title>
@endsection
@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Login</h3>
        </div>
        <div class="card-body">
            @if (Request::is('admin/*'))
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone_number" name="username" type="text"
                            placeholder="name@example.com" />
                        <label for="username">Username</label>
                        @error('username')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPassword" name="password" type="password"
                            placeholder="Password" />
                        <label for="inputPassword">Password</label>
                        @error('password')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>
            @else
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone_number" name="phone_number" type="text"
                            placeholder="name@example.com" />
                        <label for="phone_number">nomor telepon</label>
                        @error('phone_number')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPassword" name="password" type="password"
                            placeholder="Password" />
                        <label for="inputPassword">Password</label>
                        @error('password')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                        <label class="form-check-label" for="inputRememberPassword">Remember
                            Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="{{ route('password.request') }}">Forgot
                            Password?</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a>
            </div>
        </div>
    </div>
@endsection
