@extends('layouts.app')

@section('content')
    <form action="{{ route('bulletin.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea rows="5" class="form-control" name="body"></textarea>
            @error('body')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
            @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="text-center mt-30 mb-30">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
    @forelse ($bulletins as $bulletin)
        <div class="post">
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
            <form class="form-inline mt-50">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                </div>
                {{-- <a type="submit" class="btn btn-default mb-2" data-toggle="modal" data-target="#editModal"><i
                        class="fa fa-pencil p-3"></i></a> --}}
                {{-- <a type="submit" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal"><i
                        class="fa fa-trash p-3"></i></a> --}}
                <button type="submit" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal"><i
                        class="fa fa-trash p-3"></i></button>
            </form>
        </div>
    @empty
        <center>
            You don't have any bulletin yet, try to make a new one.
        </center>
    @endforelse
@endsection
