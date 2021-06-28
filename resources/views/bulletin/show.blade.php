@extends('layouts.app')

@section('content')
    <div class="post">
        delete
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="mb-5 text-green"><b>{{ $bulletin->title }}</b></h2>
            </div>
            <div class="pull-right text-right">
                <p class="text-lgray">{{ $bulletin->created_at }}</p>
            </div>
        </div>
        <p>
            {{ $bulletin->body }}
        </p>
        <form class="form-inline mt-50" action="{{ route('post.password', ['bulletin' => $bulletin->id]) }}"
            method="POST">
            @method('POST')
            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword2" placeholder="Password">
            </div>
            {{-- <a type="submit" class="btn btn-default mb-2" data-toggle="modal" data-target="#editModal"><i
                        class="fa fa-pencil p-3"></i></a> --}}
            {{-- <a type="submit" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal"><i
                        class="fa fa-trash p-3"></i></a> --}}
            <button type="submit" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal"><i
                    class="fa fa-trash p-3"></i></button>
        </form>
    </div>
@endsection
