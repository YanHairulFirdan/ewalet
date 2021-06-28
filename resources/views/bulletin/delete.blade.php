@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <h2 class="mb-5 text-green"><b>{{ $bulletin->title }}</b></h2>
    </div>
    <p>
        {{ $bulletin->body }}
    </p>
    <div class="">
        <p class="text-lgray">Date:{{ $bulletin->created_at }}</p>
    </div>
    <hr>

    <div class="row d-flex justify-content-around ">
        <div class="col-md-4">
            <form action="{{ route('bulletin.delete', ['bulletin' => $bulletin->id]) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-lg btn-danger">Yes</button>
            </form>
        </div>
        <div class="col-md-4">
            <a href="{{ url('bulletin?page=' . $currentPage) }}" class="btn btn-lg btn-primary">cancel</a>
        </div>
    </div>
@endsection
