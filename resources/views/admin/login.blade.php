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
                    <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                    <label for="inputPassword">Password</label>
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">login</button>
            </form>
        </div>
    </div>
@endsection
