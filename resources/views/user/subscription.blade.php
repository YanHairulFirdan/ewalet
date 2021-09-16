@extends('layouts.app')

@section('title')
    <title>Mulai Berlangganan</title>
@endsection

@section('content')
   <div class="d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Create Account</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <div class=" mb-3 mb-md-0">
                            <label for="type">Jenis Layanan</label>
                            <select name="type" id="type" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}} {{$type->price>0?number_format($type->price):$type->price}} selama {{$type->subscription_days}} hari</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit">pilih</button>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="login.html">Have an account? Go to login</a></div>
            </div>
        </div>
    </div>
   </div>
@endsection