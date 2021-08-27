@extends('auth.layouts.main')

@section('title')
    <title>Register - SB Admin</title>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Create Account</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputName" type="text" name="name"
                                placeholder="Enter your name" />
                            <label for="inputName">Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputPhoneNumber" type="text" name="phone_number"
                                placeholder="Enter your phone number" />
                            <label for="inputPhoneNumber">Phone Number</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputPassword" type="text" name="password"
                                placeholder="Enter your password" />
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" id="inputPasswordCOnfirmation" type="text"
                                name="password_confirmation" placeholder="Confirm your password" />
                            <label for="inputPasswordCOnfirmation">Password</label>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Create
                                Account</button></div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="login.html">Have an account? Go to login</a></div>
            </div>
        </div>
    </div>
@endsection
