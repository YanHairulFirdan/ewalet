@extends('layouts.app')

@section('content')
    <form action="{{ route('bulletin.update', ['bulletin' => $bulletin->id]) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="{{ $bulletin->title }}">
            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea rows="5" class="form-control" name="body">{{ $bulletin->body }}</textarea>
            @error('body')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="text-center mt-30 mb-30">
            <button class="btn btn-primary">Submit</button>
            <a href="{{ url('bulletin?page=' . Session::get('currentPage')) }}" class="btn btn-danger">cancel</a>

        </div>
    </form>
@endsection
