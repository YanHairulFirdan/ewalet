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
        <x-post :bulletin="$bulletin">
            @include('bulletin.slots.form')
        </x-post>
    @empty
        <h5 class="text-center">
            You don't have any bulletin yet, try to make a new one.
        </h5>
    @endforelse
@endsection
