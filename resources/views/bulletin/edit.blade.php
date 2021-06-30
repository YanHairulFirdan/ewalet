@extends('layouts.app')

@section('content')
    <form action="{{ route('bulletin.update', ['bulletin' => $bulletin->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
        @if (file_exists('storage/images/' . $bulletin->id . '-' . $bulletin->title . '.jpg'))
            <div class="img-box my-10">
                <img class="img-responsive img-post float-right" style="height: 6em" class=""
                    src="{{ asset('storage/images/' . $bulletin->id . '-' . $bulletin->title . '.jpg') }}" alt="image">
            </div>
        @endif
        <div class="form-group">
            <label>Choose image from your computer :</label>
            <div class="input-group">
                <input type="text" class="form-control upload-form" value="No file chosen" readonly>
                <span class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file" name="image" multiple>
                    </span>
                </span>
            </div>

            @error('image')
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
